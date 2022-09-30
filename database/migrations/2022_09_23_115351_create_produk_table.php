<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('nama', 100);
            $table->string('img_produk');
            $table->string('img_processing', 300);
            $table->string('harga', 100);
            $table->string('rating', 10);
            $table->string('deskripsi');
            $table->integer('id_kategori');
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
        Schema::dropIfExists('produk');
    }
}
