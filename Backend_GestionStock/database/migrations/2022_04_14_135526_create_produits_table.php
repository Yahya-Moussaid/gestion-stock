<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produits', function (Blueprint $table) {
            $table->id();
            $table->text('familleProduit');
            $table->string('nomProduit',30);
            $table->string('referenceProduit',30);
            $table->text('description');
            $table->float('prixAchat');
            $table->float('prixVente');
            $table->float('commission');
            $table->integer('qauntitestock');
            $table->timestamps();
            //---------foreign key-------------------
            $table->foreignId('depot_id')->constrained('depots')->onDelete('cascade')->onUpdate('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produits');
    }
}
