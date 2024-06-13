@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Data Barang Masuk</h1>
                        <form action="{{ route('barangmasuk.index') }}" method="GET" class="form-inline mb-3">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
            </div>
                <div class="card">
                    <div class="card-body">
                        <a href="{{ route('barangmasuk.create') }}" class="btn btn-md btn-success mb-3">TAMBAH BARANG MASUK</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>TANGGAL MASUK</th>
                            <th>QTY MASUK</th>
                            <th>BARANG</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($barangmasuk as $rowbarangmasuk)
                            <tr>
                                <td>{{ $rowbarangmasuk->id }}</td>
                                <td>{{ $rowbarangmasuk->tgl_masuk }}</td>
                                <td>{{ $rowbarangmasuk->qty_masuk }}</td>
                                <td>{{ $rowbarangmasuk->barang->merk }} - {{ $rowbarangmasuk->barang->seri }}</td>
                                <td>
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('barangmasuk.destroy', $rowbarangmasuk->id) }}" method="POST">
                                        <a href="{{ route('barangmasuk.show', $rowbarangmasuk->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('barangmasuk.edit', $rowbarangmasuk->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                        <tr>
                                <td colspan="7" class="text-center">Data Barang Masuk belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
