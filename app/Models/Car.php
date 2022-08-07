<?php

namespace App\Models;

use App\Models\Brand;
use App\Models\Transmission;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['brand', 'transmission'];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function transmission() {
        return $this->belongsTo(Transmission::class);
    }

    public function course() {
        return $this->hasMany(Course::class);
    }
}
