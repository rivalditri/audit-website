<?php

namespace App\Models;

use CodeIgniter\Model;

class Task_validation_model extends Model
{
    protected $table = 'task_validation';
    protected $primaryKey = 'id_task_validation';
    protected $allowedFields = ['id_status', 'komentar', 'validation_by'];
    protected $useSoftDeletes = false;
    protected $updatedField = 'validation_at';
    protected $useTimestamps = true;
    protected $returnType = 'object';

    public function getValidation($id_file)
    {
        $builder = $this->db->table($this->table);
        $builder->select('*')->where('id_file_dokumen', $id_file);
        $query = $builder->get();
        return $query->getResult()[0];
    }

    public function getStatusDokumen($id)
    {
        $builder = $this->db->table('m_status_dokumen');
        $builder->select('status')->where('id_status_dokumen', $id);
        $query = $builder->get();
        return $query->getResult()[0]->status;
    }
}
