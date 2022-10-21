<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKonveksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('konveksi', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('img_profil', 500);
            $table->string('nama', 100);
            $table->string('bio', 100);
            $table->string('rating', 10);
            $table->string('link_wa');
            $table->string('link_porto');
            $table->string('jmlh_project', 10);
            $table->integer('id_kategori')->index('id_kategori');
            $table->integer('id_tarif')->index('id_tarif');
            $table->integer('id_pengalaman')->index('id_pengalaman');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('konveksi');
    }
}
