<?php

namespace App\Models;

use App\Models\Car;
use App\Models\User;
use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class enroll extends Model
{
    use HasFactory;
    
    protected $guarded = ['id'];
    protected $with = ['user', 'package', 'car'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function package() {
        return $this->belongsTo(Package::class);
    }
    public function car() {
        return $this->belongsTo(Car::class);
    }
}
