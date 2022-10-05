<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToKonveksiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('konveksi', function (Blueprint $table) {
            $table->foreign(['id_pengalaman'], 'konveksi_ibfk_3')->references(['id'])->on('pengalaman_konveksi');
            $table->foreign(['id_tarif'], 'konveksi_ibfk_2')->references(['id'])->on('tarif');
            $table->foreign(['id_kategori'], 'konveksi_ibfk_1')->references(['id'])->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('konveksi', function (Blueprint $table) {
            $table->dropForeign('konveksi_ibfk_3');
            $table->dropForeign('konveksi_ibfk_2');
            $table->dropForeign('konveksi_ibfk_1');
        });
    }
}
