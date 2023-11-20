<?php

namespace App\Models;

use CodeIgniter\Model;

class FoodsModel extends Model
{

    protected $table            = 'tb_foods';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['food_name', 'carb', 'prot', 'fat', 'kcal'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules      = [
        'food_name' => 'required|is_unique[tb_foods.food_name]'
    ];
}
