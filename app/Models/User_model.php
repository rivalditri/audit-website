<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    function __construct()
    {
        $this->db = db_connect();
    }

    function tampildata()
    {
        $dataquery = $this->db->query("select * from m_user WHERE id_user <> 1");
        return $dataquery->getResult();
    }
}
