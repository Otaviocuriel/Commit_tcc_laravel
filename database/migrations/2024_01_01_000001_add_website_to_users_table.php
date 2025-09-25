<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['website', 'cep', 'endereco', 'latitude', 'longitude']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('website')->nullable()->after('role');
            $table->string('cep', 9)->nullable()->after('website');
            $table->string('endereco')->nullable()->after('cep');
            $table->decimal('latitude', 10, 7)->nullable()->after('endereco');
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude');
        });
    }
};
