<?php

// database/migrations/xxxx_xx_xx_create_dominios_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDominiosTable extends Migration
{
    public function up()
    {
        Schema::create('dominios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained()->onDelete('cascade');
            $table->string('nombre');
            $table->string('estado');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dominios');
    }
}

