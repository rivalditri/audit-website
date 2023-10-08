<?php

namespace App\Models;

use CodeIgniter\Model;

class Aspek_model extends Model
{
    function __construct()
    {
        $this->db = db_connect();
    }

    function tampildata()
    {
        $dataquery = $this->db->query("select * from m_aspek");
        return $dataquery->getResult();
    }
}
