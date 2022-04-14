<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factures', function (Blueprint $table) {
            $table->id();
            $table->integer('tva');
            $table->float('montantTotal');
            $table->float('monyantTtc');
            $table->timestamps();
            //---------foreign key-------------------
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('command_id')->constrained('commands')->onDelete('cascade')->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factures');
    }
}
