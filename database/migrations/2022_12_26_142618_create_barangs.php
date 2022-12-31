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
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_brg');
            $table->integer('harga_brg');
            $table->integer('satuan');
            $table->string('kota_brg');
            $table->text('deskripsi');
            $table->integer('stok');
            $table->integer('terjual');
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('kategori_id');
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
        Schema::dropIfExists('barangs');
    }
};
