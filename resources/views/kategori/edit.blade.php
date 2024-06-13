@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" enctype="multipart/form-data">                    
                            @csrf
                            @method('PUT') <!-- Tambahkan ini untuk menandai bahwa ini adalah metode PUT (update) -->

                            <div class="form-group">
                                <label class="font-weight-bold">DESKRIPSI</label>
                                <input type="text" class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" value="{{ old('deskripsi', $kategori->deskripsi) }}" placeholder="Masukkan Nama Kategori">
                            
                                <!-- error message untuk kategori -->
                                @error('dekripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold" for="jenis">JENIS</label>
                                <select class="form-select @error('kategori') is-invalid @enderror" name="kategori" id="kategori" aria-label="Default select example">
                                    <option value="blank" selected disabled>Pilih Jenis</option>
                                    <option value="M" {{ $kategori->kategori == 'M' ? 'selected' : '' }}>M</option>
                                    <option value="A" {{ $kategori->kategori == 'A' ? 'selected' : '' }}>Alat</option>
                                    <option value="BHP" {{ $kategori->kategori == 'BHP' ? 'selected' : '' }}>Barang Habis Pakai</option>
                                    <option value="BTHP" {{ $kategori->kategori == 'BTHP' ? 'selected' : '' }}>Barang Tidak Habis Pakai</option>
                                </select>

                                <!-- error message untuk jenis -->
                                @error('kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <a href="{{ route('kategori.index') }}" class="btn btn-md btn-warning">BATAL</a>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
