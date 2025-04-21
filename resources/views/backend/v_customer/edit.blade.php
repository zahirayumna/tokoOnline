@extends('backend.v_layouts.app')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
<div class="row">
<div class="col-12">
<div class="card">
<form action="{{ route('backend.customer.update', $edit->id) }}" method="post" enctype="multipart/form-data">
@method('put')
@csrf

<div class="card-body">
    <h4 class="card-title"> {{$judul}} </h4>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label>Foto</label>
                {{-- view image --}}
                    @if ($edit->foto)
                        <img src="{{ asset('storage/img-user/' . $edit->foto)}}" class="foto-preview" width="100%">
                        <p></p>
                    @else
                        <img src="{{ asset('storage/img-user/img-default.jpg')}}" class="foto-preview" width="100%">
                        <p></p>
                    @endif
                {{-- file foto --}}

                <input type="file" name="foto" class="form-control
                @error('foto') is-invalid @enderror" onchange="previewFoto()">
                @error('foto')
                    <div class="invalid-feedback alert-danger">{{ $message}}</div>
                @enderror
            </div>
        </div>

        <div class="col-md-8">
            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="nama" value="{{ old('nama', $edit->user->nama) }}" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan Nama">
                @error('nama')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="{{ old('email', $edit->user->email) }}" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan Email">
                @error('email')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror" placeholder="Masukkan Alamat">{{ old('alamat', $edit->alamat) }}</textarea>
                @error('alamat')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" name="pos" value="{{ old('pos', $edit->pos) }}" class="form-control @error('pos') is-invalid @enderror" placeholder="Masukkan Kode Pos">
                @error('pos')
                <span class="invalid-feedback alert-danger" role="alert">
                    {{ $message }}
                </span>
                @enderror
            </div>
        </div>
    </div>
</div>

<div class="border-top">
    <div class="card-body">
        <button type="submit" class="btn btnprimary">Simpan Perubahan</button>
        <a href="{{ route('backend.customer.index') }}"></a>
        <button type="button" class="btn btnsecondary">Kembali</button>
    </div>
</div>

</form>
</div>
</div>
</div>
</div>
@endsection