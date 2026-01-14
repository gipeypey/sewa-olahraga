@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-12 mb-4 order-0">
        <div class="card">
            <div class="d-flex align-items-end row">
                <div class="col-sm-7">
                    <div class="card-body">
                        <h5 class="card-title text-primary">Selamat Datang, {{ Auth::user()->name }}! 🎉</h5>
                        <p class="mb-4">
                            Sistem persewaan hari ini memiliki <span class="fw-bold">{{ $peminjamanPending }}</span> pengajuan sewa yang butuh persetujuan kamu.
                        </p>
                        <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-sm btn-outline-primary">Lihat Pengajuan</a>
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

    <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-primary p-2"><i class="bx bx-dumbbell text-primary"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Total Alat</span>
                        <h3 class="card-title mb-2">{{ $totalAlat }}</h3>
                        <small class="text-success fw-semibold">Unit Tersedia</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-info p-2"><i class="bx bx-category text-info"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Kategori</span>
                        <h3 class="card-title mb-2">{{ $totalKategori }}</h3>
                        <small class="text-muted">Jenis Olahraga</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-warning p-2"><i class="bx bx-time text-warning"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pending</span>
                        <h3 class="card-title mb-2">{{ $peminjamanPending }}</h3>
                        <small class="text-danger fw-semibold">Butuh Review</small>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-6 mb-4">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title d-flex align-items-start justify-content-between">
                            <div class="avatar flex-shrink-0">
                                <span class="badge bg-label-success p-2"><i class="bx bx-wallet text-success"></i></span>
                            </div>
                        </div>
                        <span class="fw-semibold d-block mb-1">Pendapatan</span>
                        <h3 class="card-title mb-2">Rp{{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                        <small class="text-success fw-semibold">Total Sewa Disetujui</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-lg-12 mb-4">
        <div class="card">
            <h5 class="card-header">Transaksi Terbaru</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Alat</th>
                            <th>Status</th>
                            <th>Total Biaya</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach($peminjamanTerbaru as $transaksi)
                        <tr>
                            <td>{{ $transaksi->user->name }}</td>
                            <td>{{ $transaksi->product->nama }}</td>
                            <td>
                                <span class="badge bg-label-{{ $transaksi->status == 'disetujui' ? 'success' : ($transaksi->status == 'pending' ? 'warning' : 'danger') }}">
                                    {{ $transaksi->status }}
                                </span>
                            </td>
                            <td>Rp {{ number_format($transaksi->total_biaya, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection