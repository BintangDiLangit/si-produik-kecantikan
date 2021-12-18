<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class KategoriKosmetikController extends Controller
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
			'http://127.0.0.1:8001/api/kategori',
		)->getBody()->getContents();

		$fixData = json_decode($data, true);
		// dd($fixData);
		return view('kategori.index', ['data' => $fixData['data']]);
	}

	function store(Request $request)
	{
		$client = new Client();;
		$res = $client->request('POST', 'http://127.0.0.1:8001/api/kategori', [
			'json' => [
				'nama_kategori' => $request->nama_kategori
			]
		]);
		return redirect(route('kategoriKosmetik.index'));
	}

	public function update(Request $request, $id)
	{
		$client = new Client();
		// dd($request);
		$data = $client->request('PUT', 'http://127.0.0.1:8001/api/kategori/' . $id, [
			'json' => [
				'nama_kategori' => $request->nama_kategori
			]
		]);
		return redirect(route('kategoriKosmetik.index'));
	}
	public function destroy($id)
	{
		$client = new Client();
		$data = $client->request('DELETE', 'http://127.0.0.1:8001/api/kategori/' . $id);
		return redirect(route('kategoriKosmetik.index'));
	}
}
