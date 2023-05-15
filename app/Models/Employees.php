<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table='employees';
    protected $fillable = [
        'name',
        'type',
        'gender',
        'manager_id'
    ];
    public function manager()
    {
        return $this->belongsTo(Manager::class);
    }
}
