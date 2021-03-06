<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('modelo');
            $table->string('marca');
            $table->string('titulo');
            $table->decimal('costoUSD');
            $table->decimal('costoMXN',15,5);
            $table->decimal('peso');
            $table->string('imagen');
            $table->longText('descripcion');
            $table->integer('categoria_id')->unsigned()->nullable();
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->integer('inventario');
            $table->timestamps();

            $table->index(['modelo', 'marca', 'titulo']); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productos');
    }
}
