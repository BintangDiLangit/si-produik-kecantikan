<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriKosmetik extends Model
{
	use HasFactory;
	protected $guarded = [];

	protected $table = 'kategori_kosmetiks';
	public function produk_kosmetiks()
	{
		return $this->hasMany(ProdukKosmetik::class, 'id_kategori', 'id');
	}
}
