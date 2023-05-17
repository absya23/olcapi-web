<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table = "user";
    protected $fillable = ["id_user","username", "name", "password", "email", "address", "phone"];
    // favorite product

    protected $hidden = ["password"];
    protected $primaryKey = 'id_user';
}