<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function scopeUserActive($query){
        return $query->where('user_id', auth()->user()->id);
    }

    public function transaksiDetail(){
        return $this->hasMany(TransaksiDetail::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
