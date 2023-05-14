<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentsModel extends Model
{
    protected $table='students';
     protected $casts =[
         'regno'=>'array'
     ];
    use HasFactory;
}
