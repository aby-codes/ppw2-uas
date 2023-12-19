<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    
    protected $fillable = [
        'buku_id', 
        'id',
        'nama_kategori',
    ];

    public function categories()
    {
        return $this->belongsTo(Buku::class);
    }
}
