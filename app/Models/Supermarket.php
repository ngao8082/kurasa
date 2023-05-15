<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supermarket extends Model
{
    use HasFactory;
    protected $table='supermarkets';
    protected $fillable = [
        'name',
        'location',
    ];

     protected $casts =[
         'id'=>'array'
     ];

    public function managers()
    {
        return $this->belongsTo(Manager::class);
        return $this->hasMany(Manager::class);
    }

}
