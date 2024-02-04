<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Models\Aspek_model;
use App\Models\Indikator_model;
use App\Models\User_model;
use App\Models\Level_indikator_model;
use App\Models\Level_proses_model;
use App\Models\Task_validation_model;
use App\Models\Dokumen_model;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;
    protected $aspek_model;
    protected $user_model;
    protected $indikator_model;
    protected $levelIndikator_model;
    protected $levelProses_model;
    protected $taskValidation_model;
    protected $dokumen_model;
    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.
        $this->dokumen_model = new Dokumen_model();
        $this->aspek_model = new Aspek_model();
        $this->user_model = new User_model();
        $this->indikator_model = new Indikator_model();
        $this->levelIndikator_model = new Level_indikator_model();
        $this->levelProses_model = new Level_proses_model();
        $this->taskValidation_model = new Task_validation_model();
        // E.g.: $this->session = \Config\Services::session();
    }
    public function capaian($id_indikator)
    {
        $id_user = session()->get('user');
        $cpu = array();
        $csatker = array();
        $levelindikator = $this->levelIndikator_model->getLevel($id_indikator);
        foreach ($levelindikator as $level) {
            $result = 0;
            $idLevel = $level->id_level_kapabilitas;
            $jumlah = $this->levelProses_model->countProses($idLevel)->jumlah_proses;
            $count = $this->dokumen_model->getUploadedDocument($idLevel, $id_user);
            foreach ($count as $value) {
                $id_file = $value->id_file_dokumen;
                $result += $this->taskValidation_model->countValidDoc($id_file)->validCount;
            }
            //hitung jumlah level kapabilitas
            $count = count($count);
            $cpu[$idLevel] = $count / $jumlah;
            $cpu[$idLevel] = round($cpu[$idLevel] * 100, 2);
            $csatker[$idLevel] = $result / $jumlah;
            $csatker[$idLevel] = round($csatker[$idLevel] * 100, 2);
        }
        $data = [
            "cpu" => $cpu,
            "csatker" => $csatker,
        ];
        return $data;
    }
    public function hitungLevel($id_aspek)
    {
        $indikators = $this->indikator_model->where('id_aspek', $id_aspek)->findAll();

        foreach ($indikators as $indikator) {
            $i = 1;
            $id_indikator = $indikator->id_indikator;
            $capaian = $this->capaian($id_indikator);
            $satker = $capaian['csatker'];
            foreach ($satker as $value) {
                if ($value >= 50) {
                    $i += 1;
                }
            }
            $level[$id_indikator] = $i;
        }
        return $level;
    }

    public function averageLevel($level)
    {
        // Menghitung jumlah nilai dalam array
        $total = array_sum($level);
        // Menghitung jumlah elemen dalam array
        $count = count($level);
        // Menghitung rata-rata
        $average = $total / $count;
        return $average;
    }

    private function avgIndikator($levelIndikator, $id_user)
    {
        $value = 100;
        foreach ($levelIndikator as $level) {
            $ValidDokumen = 0;
            $idLevel = $level->id_level_kapabilitas;
            $jumlahProses = $this->levelProses_model->countProses($idLevel)->jumlah_proses;
            $jumlahDokumen = $this->dokumen_model->getUploadedDocument($idLevel, $id_user);
            foreach ($jumlahDokumen as $dokumen) {
                $id_file = $dokumen->id_file_dokumen;
                $ValidDokumen += $this->taskValidation_model->countValidDoc($id_file)->validCount;
            }
            $jumlahDokumen = count($jumlahDokumen);
            $mean = $ValidDokumen / $jumlahProses;
            $mean = round($mean * 100, 2);
            $value += $mean;
        }
        return $value;
    }

    public function capaianIndikator($indikators)
    {
        $user = $this->user_model->getUsers();
        foreach ($indikators as $indikator) {
            $levelindikator = $this->levelIndikator_model->getLevel($indikator->id_indikator);
            foreach ($user as $u) {
                $value = $this->avgIndikator($levelindikator, $u->id_user);
                $presentase[$u->id_user][$indikator->id_indikator] = $value / count($levelindikator);
            }
        }

        return $presentase;
    }

    public function capaianAspek($capaianIndikator)
    {
        $total = 0;
        foreach ($capaianIndikator as $key => $value) {
            $total = array_sum($value);
            $average[$key] = $total / count($value);
        }
        return $average;
    }
}
