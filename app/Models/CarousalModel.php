<?php

namespace App\Models;
use CodeIgniter\Model;

class CarousalModel extends Model
{
    protected $table = 'carousals';
    protected $primaryKey = 'id';
    protected $allowedFields = ['image', 'code', 'status', 'created_at'];
}