<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    use HasFactory;

    protected $table = 'penerbit';
    protected $guarded = [];

    // Relasi ke Buku
    public function buku()
    {
        return $this->hasOne(Buku::class, 'penerbit_id', 'id');
    }
    
}
