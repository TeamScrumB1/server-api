<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('project', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('id_user')->index('id_user');
            $table->string('judul');
            $table->string('kebutuhan');
            $table->string('biaya');
            $table->string('lampiran', 500);
            $table->string('size');
            $table->string('link_gambar', 300);
            $table->date('created_at');
            $table->integer('id_desainer')->index('id_desainer');
            $table->integer('id_konveksi')->index('id_konveksi');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project');
    }
}
