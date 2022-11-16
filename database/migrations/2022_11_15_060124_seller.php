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
        Schema::create('sellers', function (Blueprint $table) {
            $table->uuid('id')->unique()->comment('Identificador único de cada registro');
            $table->enum('admin', ['0', '1'])->comment('Determina si el vendedor es administrador de la tienda (0 => No, 1 => Si)');
            $table->integer('priority')->default(1)->comment('Determina la prioridad para recibir mensajes en la tienda asociada (1 => Recibe mensajes a medida que llegan, 2 o más => Recibe mensajes cuando los vendedores de niveles anteriores an alcanzado el tope)');
            $table->uuid('seller_id')->comment('Identificador del vendedor asociado');
            $table->foreignUuid('store_id')
                ->comment('Identificador de la tienda asociada')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
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
        Schema::dropIfExists('sellers');
    }
};
