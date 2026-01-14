@extends('layouts.admin')

@section('content')
<div class="card">
    <h5 class="card-header">Daftar Pengajuan Peminjaman</h5>
    <div class="table-responsive text-nowrap">
        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Alat</th>
                    <th>Durasi</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($peminjamans as $item)
                <tr>
                    <td>{{ $item->user->name }}</td>
                    <td>{{ $item->product->nama }}</td>
                    <td>{{ $item->tanggal_pinjam }} s/d {{ $item->tanggal_kembali }}</td>
                    <td>Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge {{ $item->status == 'pending' ? 'bg-label-warning' : ($item->status == 'disetujui' ? 'bg-label-success' : 'bg-label-danger') }}">
                            {{ strtoupper($item->status) }}
                        </span>
                    </td>
                    <td>
                        @if($item->status == 'pending')
                        <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="disetujui">
                            <button class="btn btn-sm btn-success">Setujui</button>
                        </form>
                        <form action="{{ route('admin.peminjaman.status', $item->id) }}" method="POST" class="d-inline">
                            @csrf @method('PATCH')
                            <input type="hidden" name="status" value="ditolak">
                            <button class="btn btn-sm btn-danger">Tolak</button>
                        </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection