<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockchainTransaction extends Model
{
    protected $table = 'blockchain_transactions';

    protected $fillable = [
        'user_id',
        'oferta_id',
        'empresa',
        'price',
        'tx_hash',
        'chain',
        'status',
    ];
}
