<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransaksiDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaksi_id',
        'kamar_id',
        'checkin',
        'checkout',
        'tamu',
        'jumlah',
        'no_hp',
        'status'
    ];
    public $timestamps = false;

    public function kamar(){
        return $this->belongsTo(Kamar::class);
    }

    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}
