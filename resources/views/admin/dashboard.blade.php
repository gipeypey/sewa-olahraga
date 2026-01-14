@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">Selamat Datang, Admin! 🎉</h5>
              <p class="mb-4">
                Kamu memiliki akses penuh untuk mengelola Kategori, Alat Olahraga, dan Persetujuan Peminjaman.
              </p>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140" alt="View Badge User" />
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection