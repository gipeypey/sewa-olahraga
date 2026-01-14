@extends('layouts.user')

@section('content')
<div class="card">
    <h5 class="card-header">Riwayat Peminjaman Anda</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Alat</th>
                    <th>Tgl Pinjam</th>
                    <th>Tgl Kembali</th>
                    <th>Total Biaya</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody class="table-border-bottom-0">
                @foreach($peminjamans as $item)
                <tr>
                    <td><strong>{{ $item->product->nama }}</strong></td>
                    <td>{{ $item->tanggal_pinjam }}</td>
                    <td>{{ $item->tanggal_kembali }}</td>
                    <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                    <td>
                        @if($item->status == 'pending')
                            <span class="badge bg-label-warning">Menunggu Persetujuan</span>
                        @elseif($item->status == 'disetujui')
                            <span class="badge bg-label-success">Disetujui / Sedang Disewa</span>
                        @elseif($item->status == 'selesai')
                            <span class="badge bg-label-info">Selesai Dikembalikan</span>
                        @else
                            <span class="badge bg-label-danger">Ditolak</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection