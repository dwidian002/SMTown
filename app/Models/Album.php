<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "album";
    protected $primaryKey = "id_album";

    protected $fillable = [
        'name_album',
        'gambar_album',
        'genre',
        'barcode',
        'id_artist',
        'price',
        'stock'
    ];

    public function artist()
    {
        return $this->belongsTo(Artist::class, 'id_artist');
    }

    // Automatically generate a unique barcode when creating a new album
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($album) {
            $album->barcode = uniqid();
        });
    }
}
