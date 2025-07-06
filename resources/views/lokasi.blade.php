@extends('v_layouts.app')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h2 class="mb-4 text-center">Lokasi Kami</h2>

                <div class="card shadow">
                    <div class="card-body">
                        <h5 class="card-title">Toko Online</h5>
                        <p class="card-text">
                            Jl. Margonda No.8, Pondok Cina, Kecamatan Beji, Kota Depok, Jawa Barat <br>
                            Telepon: (021) 78893140<br>
                            Email: <a href="bsi@bsi.ac.id">bsi@bsi.ac.id</a>
                        </p>

                        <!-- Google Maps Embed -->
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.2847772421796!2d106.83025642576787!3d-6.357172543632818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ec3c53dfed75%3A0xad5f6ba586fc5d5e!2sUniversitas%20BSI%20Kampus%20Margonda!5e0!3m2!1sid!2sid!4v1751810239716!5m2!1sid!2sid"
                                width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection