<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory, SoftDeletes;
    protected $table = "artist";

    protected $primaryKey = "id_artist";

    protected $fillable = ["nama_artist","id_kategori","description","gambar_artist"];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');

    }
}
