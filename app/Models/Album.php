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

    protected $fillable = ["barcode", "name","gambar_album","id_artist", "price","genre"];

    public function artist(){
        return $this->belongsTo(Artist::class,'id_artist');

    }
}