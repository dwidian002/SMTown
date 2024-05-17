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
        
    protected $fillable = ["name","id_kategori","genre","description","image_url"];

    public function kategori(){
        return $this->belongsTo(Kategori::class,'id_kategori');

    }
}
