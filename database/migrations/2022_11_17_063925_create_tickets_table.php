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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
						$table->string("name");
						$table->text("description");
						$table->enum("status", ["open", "in_progress", "closed"]);
						$table->unsignedBigInteger("owner_id");
						$table->foreign("owner_id")->references("id")->on("users");
						$table->unsignedBigInteger("created_by");
						$table->foreign("created_by")->references("id")->on("users");
						$table->unsignedBigInteger("project_id");
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
        Schema::dropIfExists('tickets');
    }
};
