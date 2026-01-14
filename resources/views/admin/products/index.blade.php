@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Daftar Alat Olahraga</h4>
        <a href="{{ route('products.create') }}" class="btn btn-primary">
            <i class="bx bx-plus"></i> Tambah Alat
        </a>
    </div>
    
    <div class="table-responsive text-nowrap">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Gambar</th>
                    <th>Nama Alat</th>
                    <th>Kategori</th>
                    <th>Harga Sewa</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $item)
                <tr>
                    <td>
                        <img src="{{ asset('storage/' . $item->foto) }}" width="50" class="rounded">
                    </td>
                    <td><strong>{{ $item->nama }}</strong></td>
                    <td><span class="badge bg-label-primary">{{ $item->category->nama }}</span></td>
                    <td>Rp {{ number_format($item->harga, 0, ',', '.') }}/hari</td>
                    <td>{{ $item->stok }}</td>
                    <td>
                        <a href="{{ route('products.edit', $item->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                        <form action="{{ route('products.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus alat ini?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection