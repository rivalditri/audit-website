<?php

namespace App\Models;

use CodeIgniter\Model;

class Level_indikator_model extends Model
{
    protected $table = 'm_level_kapabilitas';
    protected $primaryKey = 'id_level_kapabilitas';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';

    public function getLevel($id_indikator)
    {
        $builder = $this->db->table('m_level_kapabilitas');
        $builder->select('*')->where('id_indikator', $id_indikator);
        $query = $builder->get();
        return $query->getResult();
    }
}


