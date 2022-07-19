<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transmission extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['car'];

    public function car() {
        return $this->hasMany(Car::class);
    }
}