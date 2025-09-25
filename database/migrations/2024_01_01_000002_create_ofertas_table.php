<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ofertas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('users')->onDelete('cascade');
            $table->string('titulo');
            $table->text('descricao');
            $table->string('tipo_energia'); // solar, eolica, hidrica, etc
            $table->decimal('preco_kwh', 8, 2);
            $table->integer('quantidade_disponivel'); // em kWh
            $table->date('data_inicio');
            $table->date('data_fim');
            $table->boolean('ativa')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ofertas');
    }
};
