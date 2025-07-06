@extends('backend.v_layouts.app')
@section('content')
    <div class="card p-3">
        <h3> {{ $judul }} </h3>
        <div class="pb-2 mb-2 mt-2">
            <a href="{{ route('anggota.create') }}">
                <button type="button" class="btn btn-success"><i class="fas fa-plus"></i> Tambah</button>
            </a>
        </div>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>HP</th>
                <th>Aksi</th>
            </tr>
            @foreach ($index as $row)
                <tr>
                    <td width="5%" class="text-center"> {{ $loop->iteration }} </td>
                    <td width="35%"> {{ $row->nama }} </td>
                    <td width="40%" width="10%"> {{ $row->hp }} </td>
                    <td width="15%" class="text-center">
                        <a href="{{ route('anggota.edit', ['id' => $row->id ]) }}" style="display: inline-block;">
                            <button class="btn btn-cyan btn-sm" type="button"><i class="far fa-edit"></i> Ubah</button>
                        </a>
                        <form action="{{ route('anggota.destroy', $row->id) }}" method="POST" style="display: inline-block;">
                            @method('delete')
                            @csrf
                            <button class="btn btn-danger btn-sm" type="submit"><i class="fas fa-trash"></i> Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection