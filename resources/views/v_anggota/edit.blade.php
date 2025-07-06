@extends('backend.v_layouts.app')
@section('content')
    <div class="card p-3">
        <h3> {{ $judul }} </h3>
        <form action="{{ route('anggota.update', $edit->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nama</label>
                <input type="text" name="nama" id="name" value="{{ old('nama', $edit->nama) }}"
                    placeholder="Masukkan NamaLengkap" class="form-control @error('nama')is-invalid @enderror">
                @error('nama')
                    <div class="mt-1 text-danger">
                        {{ $message }}
                    </div>
                @enderror
            </div>


            <div class="form-group">
                <label for="hp">HP</label>
                <input type="text" name="hp" id="hp" value="{{ old('hp', $edit->hp) }}" placeholder="Masukkan Nomor HP"
                    class="form-control @error('hp') is-invalid @enderror">
                @error('hp')
                    <div class="mt-1 text-danger">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <button type="submit" class="btn btn-success">Perbaharui</button>
            <a href="{{ route('anggota.index') }}">
                <button type="button" class="btn btn-secondary">Batal</button>
            </a>
        </form>
    </div>
@endsection