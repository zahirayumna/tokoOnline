@Extends('backend.v_Layouts.App')
@section('content')
<!-- contentAwal -->
<div class="container-fluid">
    <div class="card"></div>
        <div class="card-body"></div>

        <h4 class="card-title"> {{ $judul }} </h4>

        <div class="row">
        <div class="col-md-4">
            @if ($detail->user->foto)
                <img src="{{ asset('storage/img-user/' . $detail->user->foto) }}" class="img-fluid rounded" alt="foto">
            @else
                <img src="{{ asset('storage/img-user/img-default.jpg') }}" class="img-fluid rounded" alt="Default Foto">
            @endif
        </div>

        <div class="col-md-8">
            <table class="table table-striped">
                <tr>
                    <th>Nama</th>
                    <td>{{ $detail->user->nama }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $detail->user->email }}</td>
                </tr>

                <tr>
                    <th>No Hp</th>
                    <td>{{ $detail->user->hp }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $detail->alamat }}</td>
                </tr>

                <tr>
                    <th>Kode Pos</th>
                    <td>{{ $detail->pos }}</td>
                </tr>

            </table>

            <a href="{{ route('backend.customer.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>

</div>
<!-- contentAkhir -->
@endsection
