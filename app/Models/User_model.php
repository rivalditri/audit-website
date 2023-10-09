<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'id_user';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';

    public function getUsers()
    {
        $builder = $this->db->table('m_user');
        $builder->select('*')->where('is_admin', 0);
        $query = $builder->get();
        return $query->getResult();
    }
}
