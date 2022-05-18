<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportExcelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_excels', function (Blueprint $table) {
            $table->id();
            $table->integer('SID');
            $table->integer('Pkgs');
            $table->string('Recipient', 200)->nullable();
            $table->string('ContactName', 200);
            $table->string('AddressLine1', 200);
            $table->string('AddressLine2', 200)->nullable();
            $table->string('City', 120);
            $table->string('State', 5);
            $table->string('PostalCode');
            $table->string('StopInstructions')->nullable();
            $table->string('Phone', 80)->nullable();
            $table->string('Completed');
            // $table->integer('Completed')->default(0); //0 - Não entregue, 1 - Entregue
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
        Schema::dropIfExists('import_excels');
    }
}
