@extends('layouts.user')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Form Peminjaman Alat</h5>
                <small class="text-muted float-end">Stok Tersedia: {{ $product->stok }}</small>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4 mb-4">
                    <img src="{{ asset('storage/' . $product->foto) }}" alt="user-avatar" class="d-block rounded" height="100" width="100" style="object-fit: cover">
                    <div>
                        <h4>{{ $product->nama }}</h4>
                        <span class="badge bg-label-primary">{{ $product->category->nama }}</span>
                        <div class="mt-2 text-primary fw-bold">Rp {{ number_format($product->harga, 0, ',', '.') }} / hari</div>
                    </div>
                </div>

                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Mulai Pinjam</label>
                            <input type="date" class="form-control" name="tanggal_pinjam" id="tgl_pinjam" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Kembali</label>
                            <input type="date" class="form-control" name="tanggal_kembali" id="tgl_kembali" required>
                        </div>
                    </div>

                    {{-- Estimasi Harga (Simple JS Script) --}}
                    <div class="alert alert-secondary mt-2" role="alert">
                        Estimasi Total Biaya: <strong id="total_biaya">Rp 0</strong>
                        <br>
                        <small>*Durasi sewa dihitung per hari.</small>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary me-2">Konfirmasi Sewa</button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script Sederhana Hitung Harga --}}
<script>
    const hargaPerHari = {{ $product->harga }};
    const tglPinjamInput = document.getElementById('tgl_pinjam');
    const tglKembaliInput = document.getElementById('tgl_kembali');
    const totalDisplay = document.getElementById('total_biaya');

    function hitungTotal() {
        if(tglPinjamInput.value && tglKembaliInput.value) {
            const start = new Date(tglPinjamInput.value);
            const end = new Date(tglKembaliInput.value);
            
            // Hitung selisih waktu
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)); 
            
            if(diffDays > 0) {
                const total = diffDays * hargaPerHari;
                totalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(total);
            } else {
                totalDisplay.innerText = 'Tanggal kembali harus setelah tanggal pinjam';
            }
        }
    }

    tglPinjamInput.addEventListener('change', hitungTotal);
    tglKembaliInput.addEventListener('change', hitungTotal);
</script>
@endsection