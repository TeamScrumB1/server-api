<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToProdukTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->foreign(['id_konveksi'], 'produk_ibfk_2')->references(['id'])->on('konveksi');
            $table->foreign(['id_desainer'], 'produk_ibfk_1')->references(['id'])->on('desainer');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('produk', function (Blueprint $table) {
            $table->dropForeign('produk_ibfk_2');
            $table->dropForeign('produk_ibfk_1');
        });
    }
}
