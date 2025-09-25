<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'titulo',
        'descricao',
        'tipo_energia',
        'preco_kwh',
        'quantidade_disponivel',
        'data_inicio',
        'data_fim',
        'ativa'
    ];

    protected $casts = [
        'data_inicio' => 'date',
        'data_fim' => 'date',
        'ativa' => 'boolean'
    ];

    public function empresa()
    {
        return $this->belongsTo(User::class, 'company_id');
    }
}
