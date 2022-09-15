<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
						$table->string("name")->comment("Kapcsolattartó neve");
						$table->string("email")->comment("Kapcsolattartó email címe");
						$table->unsignedBigInteger("project_id")->comment("Kapcsolattartóhoz rendelt projekt.");
						$table->foreign("project_id")->references("id")->on("projects");
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
        Schema::dropIfExists('contacts');
    }
};
