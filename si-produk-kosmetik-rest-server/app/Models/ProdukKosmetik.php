<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukKosmetik extends Model
{
	use HasFactory;
	protected $guarded = [];

	protected $table = 'produk_kosmetiks';
	public function kategori_kosmetik()
	{
		return $this->belongsTo(KategoriKosmetik::class, 'id_kategori', 'id');
	}
}
