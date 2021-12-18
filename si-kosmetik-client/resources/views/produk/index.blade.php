@extends('layouts.master')
@section('title')
    Produk Kosmetik
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Produk Kosmetik</h4>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-3" data-toggle="modal" data-target="#exampleModal">
                        Tambah Produk Kosmetik
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="forms-sample" action="{{ route('produkKosmetik.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="kategori">Kategori Kosmetik</label>
                                            <select class="form-control" id="exampleFormControlSelect2"
                                                name="id_kategori">
                                                <option>- Pilih kategori kosmetik -</option>
                                                @foreach ($kategoriKosmetik as $kk)
                                                    <option value="{{ $kk['id'] }}">{{ $kk['nama_kategori'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk Kosmetik</label><br>
                                            <input type="text" name="nama_produk" class="form-control" id="nama_produk"
                                                placeholder="Masukkan nama produk kosmetik" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar_produk">Gambar Produk Kosmetik</label><br>
                                            <input type="text" name="gambar_produk" class="form-control"
                                                id="gambar_produk" placeholder="Masukkan gambar produk kosmetik" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga_produk">Harga Kosmetik (Per Buah)</label><br>
                                            <input type="number" name="harga_produk" class="form-control"
                                                id="harga_produk" placeholder="Masukkan harga produk kosmetik" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah">Jumlah</label><br>
                                            <input type="number" name="jumlah" class="form-control" id="jumlah"
                                                placeholder="Masukkan jumlah produk" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Kembali</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori Kosmetik</th>
                                <th>Nama Kosmetik</th>
                                <th>Harga per buah</th>
                                <th>Jumlah</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $produkKosmetik)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $produkKosmetik['kategori_kosmetik']['nama_kategori'] }}</td>
                                    <td>{{ $produkKosmetik['nama_produk'] }}</td>
                                    <td>{{ $produkKosmetik['harga_produk'] }}</td>
                                    <td>{{ $produkKosmetik['jumlah'] }}</td>
                                    <td>
                                        <button type="button" class="btn btn-info" data-id="{{ $produkKosmetik['id'] }}"
                                            data-toggle="modal" data-target="#exampleModal2{{ $produkKosmetik['id'] }}"
                                            id="updatebutton">
                                            Edit
                                        </button>
                                        <button type="button" class="btn btn-danger hap delete"
                                            onclick="hapusData({{ $produkKosmetik['id'] }})">Hapus</button>
                                        @if ($data != null)
                                            <div class="modal fade" id="exampleModal2{{ $produkKosmetik['id'] }}"
                                                tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Edit produk
                                                                kosmetik
                                                            </h5>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <form class="forms-sample"
                                                            action="{{ route('produkKosmetik.update', ['produkKosmetik' => $produkKosmetik['id']]) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="form-group">
                                                                    <label for="kosmetik">Kategori Kosmetik</label><br>
                                                                    <select class="form-control" name="id_kategori"
                                                                        id="exampleFormControlSelect2">
                                                                        <option>- Pilih kategori kosmetik -</option>
                                                                        @foreach ($kategoriKosmetik as $kk)
                                                                            <option
                                                                                {{ $kk['id'] == $produkKosmetik['id_kategori'] ? 'selected' : '' }}
                                                                                value="{{ $kk['id'] }}">
                                                                                {{ $kk['nama_kategori'] }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="nama_produk">Nama Produk
                                                                        Kosmetik</label><br>
                                                                    <input type="text" name="nama_produk"
                                                                        class="form-control"
                                                                        value="{{ $produkKosmetik['nama_produk'] }}"
                                                                        id="nama_produk"
                                                                        placeholder="Masukkan nama produk kosmetik"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="gambar_produk">Gambar Produk
                                                                        Kosmetik</label><br>
                                                                    <input type="text" name="gambar_produk"
                                                                        class="form-control" id="gambar_produk"
                                                                        value="{{ $produkKosmetik['gambar_produk'] }}"
                                                                        placeholder="Masukkan gambar produk kosmetik"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="harga_produk">Harga per buah</label><br>
                                                                    <input type="number" name="harga_produk"
                                                                        class="form-control"
                                                                        value="{{ $produkKosmetik['harga_produk'] }}"
                                                                        id="harga_produk"
                                                                        placeholder="Masukkan harga produk kosmetik"
                                                                        required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jumlah">Jumlah</label><br>
                                                                    <input type="number" name="jumlah"
                                                                        value="{{ $produkKosmetik['jumlah'] }}"
                                                                        class="form-control" id="jumlah"
                                                                        placeholder="Masukkan jumlah kosmetik (produk)"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Update
                                                                    Jenis</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        function hapusData(id) {
            var r = confirm("Apa anda yakin untuk menghapus data ini?");
            if (r == true) {
                console.log(id);
                $(document).on('click', '.delete', function() {
                    $.ajax({
                        url: 'produkKosmetik/' + id,
                        type: 'DELETE',
                        data: {
                            "_token": "{{ csrf_token() }}"
                        }
                    });

                    location.reload()
                })

            } else {

            }

        }
    </script>
@endpush
