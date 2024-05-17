<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTransaction extends Model
{
    use HasFactory, SoftDeletes;

    public function Transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }

    public function Album()
    {
        return $this->belongsTo(Album::class, 'id_album');
    }
}
