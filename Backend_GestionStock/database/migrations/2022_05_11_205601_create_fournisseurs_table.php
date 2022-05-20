<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFournisseursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fournisseurs', function (Blueprint $table) {
        
            $table->id()->autoIncrement();
            $table->string('nom',30);
            $table->string('prenom',30);
            $table->integer('telephone');
            $table->string('adresse');
            $table->string('pays',50); 
            $table->timestamps();
           //---------foreign key-------------------
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fournisseurs');
    }
}
