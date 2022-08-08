<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['student', 'package', 'car', 'instructor'];

    public function student() {
        return $this->belongsTo(User::class);
    }

    public function package() {
        return $this->belongsTo(Package::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }

    public function instructor() {
        return $this->belongsTo(User::class);
    }

    public function courseDetail() {
        return $this->hasMany(CourseDetail::class);
    }
}
