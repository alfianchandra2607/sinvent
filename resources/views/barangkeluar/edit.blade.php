@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangkeluar.update', $barangkeluar->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <input type="text" class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" readonly value="{{ old('barang_id', $barangkeluar->barang->merk) }}-{{ old('barang_id', $barangkeluar->barang->seri) }}" required>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL KELUAR</label>
                                <input type="date" class="form-control @error('tgl_keluar') is-invalid @enderror" name="tgl_keluar" value="{{ old('tgl_keluar', $barangkeluar->tgl_keluar) }}" required>
                                @error('tgl_keluar')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">QTY KELUAR</label>
                                <input type="number" class="form-control @error('qty_keluar') is-invalid @enderror" name="qty_keluar" value="{{ old('qty_keluar', $barangkeluar->qty_keluar) }}" required>
                                @error('qty_keluar')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Jika ingin mengaktifkan pilihan untuk memilih barang -->
                            <!-- <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-select @error('barang_id') is-invalid @enderror" name="barang_id" required>
                                    @foreach ($barangList as $barang)
                                        <option value="{{ $barang->id }}" {{ $barang->id == $barangkeluar->barang_id ? 'selected' : '' }}>{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div> -->

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <a href="{{ route('barangkeluar.index') }}" class="btn btn-md btn-warning">BATAL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
