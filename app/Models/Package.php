<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['transmission'];

    public function transmission() {
        return $this->belongsTo(Transmission::class);
    }
}
