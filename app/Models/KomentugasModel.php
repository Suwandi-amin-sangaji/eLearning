<?php

namespace App\Models;

use CodeIgniter\Model;

class KomentugasModel extends Model
{
    protected $table = 'komen_tugas';
    protected $primaryKey = 'id_komen';
    protected $allowedFields = ['id_tugas', 'email', 'pesan'];
}
