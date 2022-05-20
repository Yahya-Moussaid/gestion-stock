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
            $table->id()->autoIncrement();
            $table->string('familleProduit',50);
            $table->string('nomProduit',50);
            $table->string('referenceProduit',100);
            $table->text('description');
            $table->float('prixAchat');
            $table->float('prixVente');
            $table->string('commission',10);
            $table->integer('qauntitestock');
            $table->string('image');
            $table->timestamps();
            //---------foreign key-------------------
            $table->foreignId('depot_id')->constrained('depots')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('fournisseur_id')->constrained('fournisseurs')->onDelete('cascade')->onUpdate('cascade');
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
