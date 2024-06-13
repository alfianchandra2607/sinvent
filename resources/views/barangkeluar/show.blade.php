@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Detail Barang Keluar</h5>

                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th>ID</th>
                                    <td>{{ $barangkeluar->id }}</td>
                                </tr>
                                <tr>
                                    <th>TANGGAL KELUAR</th>
                                    <td>{{ $barangkeluar->tgl_keluar }}</td>
                                </tr>
                                <tr>
                                    <th>QTY KELUAR</th>
                                    <td>{{ $barangkeluar->qty_keluar }}</td>
                                </tr>
                                <tr>
                                    <th>BARANG</th>
                                    <td>{{ $barangkeluar->barang->merk }} - {{ $barangkeluar->barang->seri }}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
