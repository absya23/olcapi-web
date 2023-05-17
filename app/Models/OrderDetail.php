<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $table = "orderdetail";
    protected $fillable = ["id_od","id_order","id_prod", "quantity"];
    protected $primaryKey = 'id_od';
}