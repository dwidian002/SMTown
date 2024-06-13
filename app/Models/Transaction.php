<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'transaction';

    protected $fillable = [
        'code', 'date', 'subtotal', 'discount', 'total', 'created_by'
    ];

    public function itemTransaction()
    {
        return $this->hasMany(ItemTransaction::class, 'id_transaction');
    }

    public static function getLastCode($prefix)
    {
        $lastNumber = self::query()
            ->where('code', 'like', $prefix . '%')
            ->withTrashed()
            ->count();

        return $prefix . str_pad(($lastNumber + 1), 4, '0', STR_PAD_LEFT);
    }

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($transaction) {
            $transaction->itemTransaction()->delete();
        });

        static::restoring(function ($transaction) {
            $transaction->itemTransaction()->restore();
        });
    }
}
