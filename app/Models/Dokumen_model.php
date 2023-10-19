<?php

namespace App\Models;

use CodeIgniter\Model;

class Dokumen_model extends Model
{
    protected $table = 'file_dokumen';
    protected $primaryKey = 'id_file_dokumen';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';

    public function insertDokumen($data)
    {
        return $this->db->table($this->table)->insert($data);
    }
}

