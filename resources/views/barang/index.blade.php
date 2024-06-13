@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Data Barang</h1>
                    <!-- search -->
                    <form action="{{ route('barang.index') }}" method="GET" class="form-inline mb-3">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                </div>

                <!-- Tampilkan pesan kesalahan di sini -->
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barang.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG</a>

                        <!-- Search form -->

                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>MERK</th>
                            <th>SERI</th>
                            <th>SPEK</th>
                            <th>STOK</th>
                            <th>KATEGORI</th>
                            <th>FOTO</th>
                            <th>AKSI</th>


                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barang as $rowbarang)
                            <tr>
                                <td>{{ $rowbarang->id }}</td>
                                <td>{{ $rowbarang->merk }}</td>
                                <td>{{ $rowbarang->seri }}</td>
                                <td>{{ $rowbarang->spesifikasi }}</td>
                                <td>{{ $rowbarang->stok }}</td>
                                <td>{{ $rowbarang->kategori->deskripsi }}</td>
                                <td class="text-center">
                                    <img src="{{ asset('storage/foto/'.$rowbarang->foto) }}" class="rounded" style="width: 150px">
                                </td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barang.destroy', $rowbarang->id) }}" method="POST">
                                        <a href="{{ route('barang.show', $rowbarang->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barang.edit', $rowbarang->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Barang belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
