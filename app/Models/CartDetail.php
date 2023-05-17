<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartDetail extends Model
{
    use HasFactory;

    protected $table = "cartdetail";
    protected $fillable = ["id_cd", "id_user", "id_prod", "quantity"];

    protected $primaryKey = 'id_cd';
}