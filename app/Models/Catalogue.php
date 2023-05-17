<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogue extends Model
{
    use HasFactory;
    protected $table = "catalogue";
    protected $fillable = ["id_catalog","name","del_flag"];
    protected $primaryKey = 'id_catalog';
    protected $hidden = ['created_at', 'updated_at'];
}