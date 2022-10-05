<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDesainerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('desainer', function (Blueprint $table) {
            $table->foreign(['id_pengalaman'], 'desainer_ibfk_3')->references(['id'])->on('pengalaman_desainer');
            $table->foreign(['id_tarif'], 'desainer_ibfk_2')->references(['id'])->on('tarif');
            $table->foreign(['id_kategori'], 'desainer_ibfk_1')->references(['id'])->on('kategori');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('desainer', function (Blueprint $table) {
            $table->dropForeign('desainer_ibfk_3');
            $table->dropForeign('desainer_ibfk_2');
            $table->dropForeign('desainer_ibfk_1');
        });
    }
}
