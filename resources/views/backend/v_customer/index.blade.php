@extends('backend.v_layouts.app') 
@section('content') 
<!-- contentAwal --> 
 
<div class="row"> 
    <div class="col-12"> 
        <div class="card"> 
            <div class="card-body"> 
 
                <h5 class="card-title">{{$judul}} <br><br> 
                </h5> 
 
                <div class="table-responsive"> 
                    <table id="zero_config" class="table table-striped table-bordered"> 
                        <thead> 
                            <tr> 
                                <th>No</th> 
                                <th>Nama</th> 
                                <th>Email</th> 
                                <th>Aksi</th> 
                            </tr> 
                        </thead> 
                        <tbody> 
                            @foreach ($index as $row) 
                            <tr> 
                                <td> {{ $loop->iteration }} </td> 
                                <td> {{$row->user->nama}} </td> 
                                <td> {{$row->user->email}} </td> 
                                <td> 
                                    <a href="{{ route('backend.customer.show', $row->id) }}" title="Lihat Detail"> 
                                    <button type="button" class="btn btn-warning"><i class="fas fa-eye"></i> Detail</button> 
                                    </a> 
                                    <a href="{{ route('backend.customer.edit', $row->id) }}" title="Ubah Data"> 
                                        <button type="button" class="btn btn-cyan"><i class="far fa-edit"></i> Ubah</button> 
                                    </a> 
                                    <a href="#">
                                        <button type="submit" form="hapus" class="btn btn-danger show_confirm" data-konf-delete="{{ $row->nama}}" title='Hapus Data'> 
                                        <i class="fas fa-trash"></i> Hapus</button>    
                                    </a>
                                     
                                </td> 
                            </tr> 
                            @endforeach 
                        </tbody> 
                    </table> 
                </div> 
 
            </div> 
        </div> 
    </div> 
</div> 
<form method="POST" action="#" style="display: inline block;" id="hapus" 
                                        @method('delete') 
                                        @csrf </form>  

<!-- contentAkhir --> 
@endsection 