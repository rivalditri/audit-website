<?php

namespace App\Models;

use CodeIgniter\Model;

class Level_proses_model extends Model
{
    protected $table = 'm_level_kriteria';
    protected $primaryKey = 'id_level_kriteria';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';

    public function countProses($id_level)
    {
        $builder = $this->db->table($this->table)
            ->selectCount('id_level_kriteria', 'jumlah_proses')
            ->where('id_level_kapabilitas', $id_level);
        $query = $builder->get();
        return $query->getRow();
    }

    public function getAllProses($id_level_indikator)
    {
        $proses = $this->where('id_level_kapabilitas', $id_level_indikator)->findAll();
        return $proses;
    }
    public function getLevel($id_indikator)
    {
        $builder = $this->db->table('m_level_kapabilitas');
        $builder->select('*')->where('id_indikator', $id_indikator);
        $query = $builder->get();
        return $query->getResult();
    }
    public function getIndikator($id_level)
    {
        $builder = $this->db->table('m_indikator');
        $builder->select('*')->join('m_level_kapabilitas', 'm_level_kapabilitas.id_indikator = m_indikator.id_indikator')->where('id_level_kapabilitas', $id_level);
        $query = $builder->get();
        return $query->getRow();
    }
}
