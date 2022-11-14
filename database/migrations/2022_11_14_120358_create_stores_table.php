<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->uuid('id')->unique()->comment('Identificador único de cada registro');
            $table->string('name', 100)->unique()->comment('Nombre de la tienda');
            $table->enum('status', ['0', '1'])->comment('Determina el estado actual de la tienda (0 => Inactiva, 1 => Activa)');
            $table->string('url', 250)->unique()->comment('Url donde se encuentra publicado el sitio web de la tienda');
            $table->string('whatsapp', 30)->unique()->comment('Número de teléfono con cuenta de whatsapp asociado a la tienda');
            $table->string('facebook', 250)->nullable()->comment('Url de cuenta de facebook asociada a la tienda');
            $table->string('instagram', 250)->nullable()->comment('Url de cuenta de instagram asociada a la tienda');
            $table->uuid('file_id')->nullable()->comment('Identificador del archivo asociado al logo de la tienda');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stores');
    }
};
