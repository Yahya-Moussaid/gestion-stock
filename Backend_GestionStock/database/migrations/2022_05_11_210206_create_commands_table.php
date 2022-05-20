<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commands', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->integer('qauntiteCmd');
            $table->timestamps(); 
           //---------foreign key-------------------
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('produit_id')->constrained('produits')->onDelete('cascade')->onUpdate('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commands');
    }
}
