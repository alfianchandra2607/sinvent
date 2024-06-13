@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Barang Masuk</h5>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $barangmasuk->id }}</td>
                                </tr>
                                <tr>
                                    <th>TANGGAL MASUK</th>
                                    <td>{{ $barangmasuk->tgl_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>QTY MASUK</th>
                                    <td>{{ $barangmasuk->qty_masuk }}</td>
                                </tr>
                                <tr>
                                    <th>BARANG</th>
                                    <td>{{ $barangmasuk->barang->merk }} - {{ $barangmasuk->barang->seri }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
