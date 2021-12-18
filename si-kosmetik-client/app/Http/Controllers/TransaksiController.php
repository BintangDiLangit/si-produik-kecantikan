<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TransaksiController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}
	function index()
	{
		$client = new Client();
		$data = $client->request(
			'GET',
			'http://127.0.0.1:8002/api/transaksi',
		)->getBody()->getContents();

		$kosmetik = $client->request(
			'GET',
			'http://127.0.0.1:8001/api/produk',
		)->getBody()->getContents();

		$fixData = json_decode($data, true);
		$fixkosmetik = json_decode($kosmetik, true);
		return view('transaksi.index', ['data' => $fixData['data'], 'fixkosmetik' => $fixkosmetik['data']]);
	}

	function store(Request $request)
	{
		$client = new Client();

		$res = $client->request('POST', 'http://127.0.0.1:8002/api/transaksi', [
			'json' => [
				'nama_pembeli' => $request->nama_pembeli,
				'alamat' => $request->alamat,
				'no_telp' => $request->no_telp,
				'nama_produk_kosmetik' => $request->nama_produk_kosmetik,
				'total_harga' => $request->total_harga,
				'jumlah' => $request->jumlah
			]
		]);


		$id = 0;
		$stokawal = 0;

		$dataKosmetik = Http::get('http://127.0.0.1:8001/api/produk')->json();
		for ($i = 0; $i < count($dataKosmetik['data']); $i++) {
			if ($request->nama_produk_kosmetik == $dataKosmetik['data'][$i]['nama_produk']) {
				$id = $dataKosmetik['data'][$i]['id'];
				$stokawal = $dataKosmetik['data'][$i]['jumlah'];
			}
		}

		$data = $client->request('PUT', 'http://127.0.0.1:8001/api/produk/' . $id, [
			'json' => [
				'jumlah' => $stokawal - $request->jumlah
			]
		]);

		return redirect(route('transaksi.index'));
	}

	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8002/api/transaksi/' . $id);
		return redirect(route('transaksi.index'));
	}
}
