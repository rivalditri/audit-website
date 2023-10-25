<?php

namespace App\Models;

use CodeIgniter\Model;

class Dokumen_model extends Model
{
    protected $table = 'file_dokumen';
    protected $primaryKey = 'id_file_dokumen';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $returnType = 'object';

    public function insertDokumen($data)
    {
        $this->db->table($this->table)->insert($data);
        $id = $this->db->insertID();
        $data_validation = [
            'id_file_dokumen' => $id,
            'id_status' => 1,
            'komentar' => 'this document need to be reviewed',
        ];
        return $this->db->table('task_validation')->insert($data_validation);
    }
    public function getIdFile($id_proses)
    {
        $builder = $this->db->table($this->table);
        $builder->select('id_file_dokumen')->where('id_level_kriteria', $id_proses)->orderBy('id_file_dokumen', 'DESC')->limit(1);
        $query = $builder->get();
        return $query->getRow();
    }
}
