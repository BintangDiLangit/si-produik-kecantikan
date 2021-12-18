<?php

namespace App\Http\Controllers;

use App\Models\KategoriKosmetik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class KategoriKosmetikController extends Controller
{

	public function index()
	{
		$kategoris = KategoriKosmetik::with('produk_kosmetiks')->get();
		return response()->json([
			"success" => true,
			"message" => "Daftar Kategori Kosmetik",
			"data" => $kategoris
		]);
	}


	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_kategori' => 'required',
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$kategori = KategoriKosmetik::create($input);
		return response()->json([
			"success" => true,
			"message" => "Data kategori kosmetik telah ditambahkan.",
			"data" => $kategori
		]);
	}


	public function update(Request $request, $id)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_kategori' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$data = KategoriKosmetik::find($id);
		$kategori = $data->update($input);
		return response()->json([
			"success" => true,
			"message" => "Data kategori kosmetik telah diupdate.",
			"data" => $kategori
		]);
	}


	public function destroy($kategori)
	{
		KategoriKosmetik::destroy($kategori);
		return response()->json([
			"success" => true,
			"message" => "Data kategori kosmetik telah dihapus",
			"data" => $kategori
		]);
	}
}
