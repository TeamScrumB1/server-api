<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestProjectDesainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_project_desainer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_project')->index('id_project');
            $table->integer('id_desainer')->index('id_desainer');
            $table->string('status', 200);
            $table->dateTime('created_at');
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_project_desainer');
    }
}
