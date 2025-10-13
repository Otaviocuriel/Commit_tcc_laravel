<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTipoEnergiaToUsersTable extends Migration
{
    public function up()
    {
        // somente adiciona se não existir (previne Duplicate column)
        if (! Schema::hasColumn('users', 'tipo_energia')) {
            Schema::table('users', function (Blueprint $table) {
                $table->string('tipo_energia')->nullable()->after('longitude');
            });
        }
    }

    public function down()
    {
        if (Schema::hasColumn('users', 'tipo_energia')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('tipo_energia');
            });
        }
    }
}
