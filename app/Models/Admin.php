<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = "admin";
    protected $fillable = ["id_ad","admin_name","password"];
    protected $hidden = ["password"];

    protected $primaryKey = 'id_ad';

    // public function getAdmin() {
    //     // return $this->get();
    //     return "hi";
    // }
}