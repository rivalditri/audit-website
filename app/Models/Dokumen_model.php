<?php

namespace App\Models;

use CodeIgniter\Model;

class Dokumen_model extends Model
{
    protected $table = 'file_dokumen';
    protected $primaryKey = 'id_file_dokumen';
    protected $allowedFields = ['id_file_dokumen', 'file_upload', 'id_user', 'id_level_kriteria', 'created_by', 'created_at', 'updated_at', 'deleted_at'];
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'object';

    public function insertDokumen($data)
    {
        $existingdata = $this->db()->table($this->table)
            ->where('id_level_kriteria', $data['id_level_kriteria'])
            ->get()->getRow();
        if (empty($existingdata)) {
            $this->db->table($this->table)->insert($data);
            $id = $this->db->insertID();
            $data_validation = [
                'id_file_dokumen' => $id,
                'id_status' => 1,
                'komentar' => 'this document need to be reviewed',
            ];
            return $this->db->table('task_validation')->insert($data_validation);
        } else {
            $existed_id = $this->db->table($this->table)
                ->select('id_file_dokumen')
                ->where('id_level_kriteria', $data['id_level_kriteria'])
                ->where('deleted_at', null)
                ->where('id_user', $data['id_user'])
                ->get()
                ->getResult();
            $id_arr = array();
            $index = 0;
            foreach ($existed_id as $datas) {
                $id_arr[$index++] = $datas->id_file_dokumen;
            }
            $this->delete($id_arr);
            $this->db->table($this->table)->insert($data);
            $id = $this->db->insertID();
            $data_validation = [
                'id_file_dokumen' => $id,
                'id_status' => 1,
                'komentar' => 'this document need to be reviewed',
            ];
            return $this->db->table('task_validation')->insert($data_validation);
        }
    }
    public function getIdFile($id_proses)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_file_dokumen')->where('id_level_kriteria', $id_proses)->orderBy('id_file_dokumen', 'DESC')->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }
    public function getUploadedDocument($id_level)
    {
        $builder = $this->db->table('file_dokumen');
        $builder->select('id_file_dokumen, id_level_kriteria')
            ->like('id_level_kriteria', $id_level)
            ->where('deleted_at IS NULL');
        $query = $builder->get();
        $result = $query->getResult();
        return $result;
    }
}
