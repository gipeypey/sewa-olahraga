@extends('layouts.user')

@section('content')
<div class="card mb-4 bg-transparent shadow-none">
    <div class="card-body p-0">
        <h4 class="fw-bold py-3 mb-2"><span class="text-muted fw-light">Dashboard /</span> Katalog Alat</h4>
        <div class="alert alert-primary d-flex align-items-center" role="alert">
            <i class="bx bx-run me-2"></i>
            <div>
                Selamat datang, <strong>{{ Auth::user()->name }}</strong>! Siap untuk lari hari ini? Pilih alat terbaikmu di bawah ini.
            </div>
        </div>
    </div>
</div>

{{-- Pesan Sukses --}}
@if(session('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
</div>
@endif

<div class="row row-cols-1 row-cols-md-3 g-4">
    @foreach ($products as $item)
    <div class="col">
        <div class="card h-100">
            <img src="{{ asset('storage/' . $item->foto) }}" class="card-img-top" alt="{{ $item->nama }}" style="height: 240px; object-fit: cover;">
            
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="card-title mb-0">{{ $item->nama }}</h5>
                    <span class="badge bg-label-primary">{{ $item->category->nama }}</span>
                </div>
                
                <h6 class="text-primary fw-bold mb-3">Rp {{ number_format($item->harga, 0, ',', '.') }} <small class="text-muted fw-normal">/hari</small></h6>
                
                <p class="card-text text-muted small">
                    {{ Str::limit($item->deskripsi, 60) }}
                </p>
            </div>

            <div class="card-footer bg-transparent border-top-0 pb-3">
                <div class="d-grid gap-2">
                    {{-- Tombol Sewa --}}
                    {{-- Nanti kita arahkan ke route Peminjaman --}}
                    <a href="{{ route('peminjaman.create', $item->id) }}" class="btn btn-primary">
                        <i class="bx bx-cart-add me-1"></i> Sewa Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    @if($products->isEmpty())
    <div class="col-12">
        <div class="card text-center p-5">
            <div class="card-body">
                <i class="bx bx-package text-muted" style="font-size: 4rem;"></i>
                <h3 class="mt-3">Belum ada alat tersedia.</h3>
                <p>Admin belum menambahkan alat olahraga apapun.</p>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection