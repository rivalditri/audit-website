<?php

namespace App\Models;

use CodeIgniter\Model;

class Indikator_model extends Model
{
    function __construct()
    {
        $this->db = db_connect();
    }

    function tampildata()
    {
        $dataquery = $this->db->query("select * from m_indikator");
        return $dataquery->getResult();
    }
}
