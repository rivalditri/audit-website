<?php

namespace App\Models;

use CodeIgniter\Model;

class Aspek_model extends Model
{
    protected $table = 'm_aspek';
    protected $primaryKey = 'id_aspek';
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    protected $deletedField = 'delete_at';
    protected $returnType = 'object';
}
