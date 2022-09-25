<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FasilitasKamar extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kamar(){
        return $this->belongsTo(kamar::class);
    }

    public function fasilitas(){
        return $this->belongsTo(Fasilitas::class);
    }
}
