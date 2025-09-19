<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 20)->default('user')->after('password');
            $table->string('cpf', 14)->nullable()->after('role');
            $table->string('cnpj', 18)->nullable()->after('cpf');
            $table->string('telefone', 20)->nullable()->after('cnpj');
            $table->string('cep', 10)->nullable()->after('telefone');
            $table->date('data_nascimento')->nullable()->after('cep');
            $table->string('cargo', 50)->nullable()->after('data_nascimento');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['role','cpf','cnpj','telefone','cep','data_nascimento','cargo']);
        });
    }
};
