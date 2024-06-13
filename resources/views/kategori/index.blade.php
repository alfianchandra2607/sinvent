@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Kategori</h1>
                    <!-- search -->
                    <form action="{{ route('kategori.index') }}" method="GET" class="form-inline mb-3">
                            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search" value="{{ request()->query('search') }}">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>

                </div>
                
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
                        <a href="{{ route('kategori.create') }}" class="btn btn-md btn-success mb-3">TAMBAH KATEGORI</a>
                    </div>
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>DESKRIPSI</th>
                            <!-- <th>KATEGORI</th> -->
                            <th>KETERANGAN</th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($kategori as $rowkat)
                            <tr>
                                <td>{{ $rowkat->id }}</td>
                                <td>{{ $rowkat->deskripsi }}</td>
                                
                                <td>{{ $rowkat->kat }}</td>

                                <td class="text-center"> 
                                    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kategori.destroy', $rowkat->id) }}" method="POST">
                                        <a href="{{ route('kategori.show', $rowkat->id) }}" class="btn btn-sm btn-dark"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('kategori.edit', $rowkat->id) }}"" class="btn btn-sm btn-primary"><i class="fa fa-pencil-alt"></i></a>
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">Data Kategori belum tersedia</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
