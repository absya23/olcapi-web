<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Images extends Model
{
    use HasFactory;
    protected $table = "images";
    protected $fillable = ["id_img","URL","id_prod"];
    protected $primaryKey = 'id_img';
    protected $hidden = ['created_at', 'updated_at'];
}