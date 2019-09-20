<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    protected $table = "pengeluaran";

    public function Transaksi(){
        return $this->belongsTo('App\User');
    }
}
