<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = ["id_prod","id_type","name", "price", "image", "description", "quantity", "del_flag"];
    protected $primaryKey = 'id_prod';
    protected $hidden = ['created_at', 'updated_at'];

    public function type() {
        return $this->belongsTo(TypeProduct::class,'id_type');
    }
}   