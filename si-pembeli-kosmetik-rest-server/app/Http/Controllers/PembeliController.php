<?php

namespace App\Http\Controllers;

use App\Models\Pembeli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PembeliController extends Controller
{
	public function index()
	{
		$pembelis = Pembeli::get();
		return response()->json([
			"success" => true,
			"message" => "List transaksi pembelian kosmetik",
			"data" => $pembelis
		]);
	}

	public function store(Request $request)
	{
		$input = $request->all();
		$validator = Validator::make($input, [
			'nama_pembeli' => 'required',
			'alamat' => 'required',
			'no_telp' => 'required',
			'nama_produk_kosmetik' => 'required',
			'total_harga' => 'required',
			'jumlah' => 'required'
		]);
		if ($validator->fails()) {
			return $this->sendError('Validation Error.', $validator->errors());
		}
		$pembeli = Pembeli::create($input);
		return response()->json([
			"success" => true,
			"message" => "Transaksi pembelian kosmetik telah ditambahkan.",
			"data" => $pembeli
		]);
	}

	public function destroy($ikan)
	{
		Pembeli::destroy($ikan);
		return response()->json([
			"success" => true,
			"message" => "Transaksi pembelian kosmetik telah dihapus",
			"data" => $ikan
		]);
	}
}
