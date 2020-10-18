<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Client;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('document');
            $table->string('email');
            $table->string('phone');
            $table->boolean('defaulter');
            $table->date('dateBirth')->nullable();
            $table->char('gender')->nullable();
            $table->enum('maritalStatus', array_keys(Client::MARITAL_STATUS))->nullable();
            $table->string('physicalDisability')->nullable();
            $table->string('companyName')->nullable();
            $table->string('clientType');
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
        Schema::dropIfExists('clients');
    }
}
