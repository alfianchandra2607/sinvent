@extends('layouts.adm-main')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('barangmasuk.update', $barangmasuk->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <input type="text" class="form-control @error('barang_id') is-invalid @enderror" name="barang_id" readonly value="{{ old('barang_id', $barangmasuk->barang->merk) }}-{{ old('barang_id', $barangmasuk->barang->seri) }}" required>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">TANGGAL MASUK</label>
                                <input type="date" class="form-control @error('tgl_masuk') is-invalid @enderror" name="tgl_masuk" value="{{ old('tgl_masuk', $barangmasuk->tgl_masuk) }}" required>
                                @error('tgl_masuk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">QTY MASUK</label>
                                <input type="number" class="form-control @error('qty_masuk') is-invalid @enderror" name="qty_masuk" value="{{ old('qty_masuk', $barangmasuk->qty_masuk) }}" required>
                                @error('qty_masuk')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- <div class="form-group">
                                <label class="font-weight-bold">BARANG</label>
                                <select class="form-select @error('barang_id') is-invalid @enderror" name="barang_id" required>
                                    @foreach ($barangList as $barang)
                                        <option value="{{ $barang->id }}" {{ $barang->id == $barangmasuk->barang_id ? 'selected' : '' }}>{{ $barang->merk }} - {{ $barang->seri }}</option>
                                    @endforeach
                                </select>
                                @error('barang_id')
                                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div> -->

                            <button type="submit" class="btn btn-md btn-primary">SIMPAN</button>
                            <a href="{{ route('barangmasuk.index') }}" class="btn btn-md btn-warning">BATAL</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
