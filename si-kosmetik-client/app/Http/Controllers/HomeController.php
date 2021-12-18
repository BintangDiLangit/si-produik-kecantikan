<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard.
	 *
	 * @return \Illuminate\Contracts\Support\Renderable
	 */
	public function index()
	{
		$dataprodukkosmetik = Http::get('http://127.0.0.1:8001/api/produk')->json();
		$datakategorikosmetik = Http::get('http://127.0.0.1:8001/api/kategori')->json();
		$datatransaksi = Http::get('http://127.0.0.1:8002/api/transaksi')->json();
		$banyakkategori = count($datakategorikosmetik['data']);
		$banyakprodukkosmetik = count($dataprodukkosmetik['data']);
		$banyaktransaksi = count($datatransaksi['data']);

		$sumpendapatan = 0;
		for ($i = 0; $i < $banyaktransaksi; $i++) {
			$sumpendapatan += $datatransaksi['data'][$i]['total_harga'];
		}

		return view('dashboard', compact('banyakprodukkosmetik', 'banyakkategori', 'sumpendapatan', 'banyaktransaksi'));
	}
}
