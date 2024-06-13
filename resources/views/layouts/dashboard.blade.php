@extends('layouts.adm-main')

@section('content')
    <div class="container">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            </div> 
        <div class="row">
            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Barang</h5>
                        <p class="card-text">Kelola data barang siswa.</p>
                        <a href="" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Kategori</h5>
                        <p class="card-text">Kelola data kategori barang.</p>
                        <a href="" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Barang Masuk</h5>
                        <p class="card-text">Kelola data barang masuk.</p>
                        <a href="" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card mb-4">
                    <div class="card-body text-center">
                        <h5 class="card-title">Barang Keluar</h5>
                        <p class="card-text">Kelola data barang keluar.</p>
                        <a href="" class="btn btn-primary">Lihat Data</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
