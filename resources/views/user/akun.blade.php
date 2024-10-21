@extends('layouts.template')

@section('content')
    <a href="{{ route('user.create')}}" class="btn btn-secondary float-end" style="margin-bottom: 10px;" >Tambah Pengguna</a>

<!-- Tabel akun -->
<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
        @php $no = 1; @endphp
        @foreach ($akun as $item)
            <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $item['name'] }}</td>
            <td>{{ $item['email'] }}</td>
            <td>{{ $item['role'] }}</td>
            <td class="d-flex justify-content-center">
                <a href="{{route ('user.edit', $item['id'])}}"class="btn btn-primary me-3">Edit</a>
                <form action="{{route('user.delete', $item['id'])}}" method="POST">
                    @csrf
                    @method('DELETE')
                <button type="submit" class="btn btn-danger">Hapus</button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
@endsection