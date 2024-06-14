<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ItemTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'item_transaction'; // Nama tabel seharusnya `item_transactions` secara konvensional
    protected $primaryKey = 'id_item_transaction'; // Pastikan primary key sesuai dengan tabel

    protected $fillable = [
        'id_transaction', 'id_album', 'price', 'qty', 'total','updated_at','created_at'
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'id_transaction');
    }

    public function album()
    {
        return $this->belongsTo(Album::class, 'id_album');
    }
}
