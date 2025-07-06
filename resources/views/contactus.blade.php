@extends('v_layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2 class="mb-4 text-center aside-title">Hubungi Kami</h2>

            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <form action="#" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nama Anda" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email">Alamat Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="email@contoh.com"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="subject">Subjek</label>
                    <input type="text" class="form-control" id="subject" name="subject" placeholder="Subjek pesan"
                        required>
                </div>

                <div class="form-group mb-3">
                    <label for="message">Pesan</label>
                    <textarea class="form-control" id="message" name="message" rows="5"
                        placeholder="Tulis pesan Anda di sini..." required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Pesan</button>
            </form>
        </div>
    </div>
</div>
@endsection