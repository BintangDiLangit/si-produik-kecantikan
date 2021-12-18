<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ProdukKosmetikController extends Controller
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
			'http://127.0.0.1:8001/api/produk',
		)->getBody()->getContents();

		$kategoriKosmetik = $client->request(
			'GET',
			'http://127.0.0.1:8001/api/kategori',
		)->getBody()->getContents();

		$fixData = json_decode($data, true);
		$kategoriKosmetik = json_decode($kategoriKosmetik, true);
		return view('produk.index', ['data' => $fixData['data'], 'kategoriKosmetik' => $kategoriKosmetik['data']]);
	}

	function store(Request $request)
	{
		$client = new Client();;
		$res = $client->request('POST', 'http://127.0.0.1:8001/api/produk', [
			'json' => [
				'nama_produk' => $request->nama_produk,
				'harga_produk' => $request->harga_produk,
				'gambar_produk' => $request->gambar_produk,
				'jumlah' => $request->jumlah,
				'id_kategori' => $request->id_kategori
			]
		]);
		return redirect(route('produkKosmetik.index'));
	}

	public function update(Request $request, $id)
	{
		// dd($request);
		$client = new Client();
		$data = $client->request('PUT', 'http://127.0.0.1:8001/api/produk/' . $id, [
			'json' => [
				'nama_produk' => $request->nama_produk,
				'harga_produk' => $request->harga_produk,
				'gambar_produk' => $request->gambar_produk,
				'jumlah' => $request->jumlah,
				'id_kategori' => $request->id_kategori
			]
		]);
		return redirect(route('produkKosmetik.index'));
	}
	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8001/api/produk/' . $id);
		return redirect(route('produkKosmetik.index'));
	}
}
