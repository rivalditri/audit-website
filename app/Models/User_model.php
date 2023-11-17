<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'm_user';
    protected $primaryKey = 'id_user';
    protected $useAutoIncrement = false;
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';
    protected $allowedFields = ['id_user', 'email', 'nama_unit', 'inisial', 'is_admin', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    public function getUsers()
    {
        $builder = $this->db->table('m_user');
        $builder->select('*')->where('is_admin', 0);
        $query = $builder->get();
        return $query->getResult();
    }

    function saveUser($tabel, $data)
    {
        $this->db->table($tabel)->insert($data);
        return true;
    }

    function updateUser($table, $data, $where)
    {
        $this->db->table($table)->update($data, $where);
        return true;
    }

    function removeUser($id)
    {
        $this->db->query("delete from m_user where id_user=" . $id);
        return true;
    }
}
