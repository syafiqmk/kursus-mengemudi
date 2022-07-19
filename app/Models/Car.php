<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Car extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['brand', 'transmission'];

    public function brand() {
        return $this->BelongsTo(Brand::class);
    }

    public function transmission() {
        return $this->BelongsTo(Transmission::class);
    }
}
