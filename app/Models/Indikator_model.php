<?php

namespace App\Models;

use CodeIgniter\Model;

class Indikator_model extends Model
{
    protected $table = 'm_indikator';
    protected $primaryKey = 'id_indikator';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';

    public function getIndikator($id_indikator)
    {
        return $this->where('id_indikator', $id_indikator)->first()->indikator;
    }

    public function getAspek($id_indikator)
    {
        $builder = $this->db->table('m_aspek');
        $builder->select('aspek')->join('m_indikator', 'm_indikator.id_aspek = m_aspek.id_aspek')->where('m_indikator.id_indikator', $id_indikator);
        $query = $builder->get();
        return $query->getRow()->aspek;
    }
}
