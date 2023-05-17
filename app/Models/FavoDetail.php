<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoDetail extends Model
{
    use HasFactory;

    protected $table = "favodetail";
    protected $fillable = ["id_fd","id_user","id_prod"];

    protected $primaryKey = 'id_fd';
}