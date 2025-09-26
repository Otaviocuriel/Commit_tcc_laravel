<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'website')) {
                $table->dropColumn('website');
            }
            if (Schema::hasColumn('users', 'cep')) {
                $table->dropColumn('cep');
            }
            if (Schema::hasColumn('users', 'endereco')) {
                $table->dropColumn('endereco');
            }
            if (Schema::hasColumn('users', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('users', 'longitude')) {
                $table->dropColumn('longitude');
            }
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