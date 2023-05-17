<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $table = "typeproduct";
    protected $fillable = ["id_type","id_catalog","name", "del_flag"];
    protected $primaryKey = 'id_type';
    protected $hidden = ['created_at', 'updated_at'];

    public function cata() {
        return $this->belongsTo(Catalogue::class,'id_catalog');
    }
}