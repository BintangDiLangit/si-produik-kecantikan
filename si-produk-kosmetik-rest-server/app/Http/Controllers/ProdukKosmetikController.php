<?php

namespace App\Http\Controllers;

use App\Models\ProdukKosmetik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProdukKosmetikController extends Controller
{
	public function index()
	{
		$produks = ProdukKosmetik::with('kategori_kosmetik')->get();
		return response()->json([
			"success" => true,
			"message" => "Daftar Produk Kosmetik",
			"data" => $produks
		]);
	}


	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_produk' => 'required',
			'harga_produk' => 'required',
			'gambar_produk' => 'required',
			'jumlah' => 'required',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$produk = ProdukKosmetik::create($input);
		return response()->json([
			"success" => true,
			"message" => "Data produk kosmetik telah ditambahkan.",
			"data" => $produk
		]);
	}


	public function update(Request $request, $id)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'jumlah' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$data = ProdukKosmetik::find($id);
		$produk = $data->update($input);
		return response()->json([
			"success" => true,
			"message" => "Data produk kosmetik telah diupdate.",
			"data" => $produk
		]);
	}


	public function destroy($produk)
	{
		ProdukKosmetik::destroy($produk);
		return response()->json([
			"success" => true,
			"message" => "Data produk kosmetik telah dihapus",
			"data" => $produk
		]);
	}
}
