<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdukKosmetiksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('produk_kosmetiks', function (Blueprint $table) {
			$table->id();
			$table->string('nama_produk');
			$table->string('harga_produk');
			$table->string('gambar_produk');
			$table->string('jumlah');
			$table->unsignedBigInteger('id_kategori');
			$table->foreign('id_kategori')->references('id')->on('kategori_kosmetiks')->onDelete('cascade');
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
		Schema::dropIfExists('produk_kosmetiks');
	}
}
