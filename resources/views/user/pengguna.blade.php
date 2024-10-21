@extends('layouts.template')

@section('content')
<form action="{{ route('user.store')}}" method="POST">
    @csrf

    @if(Session::get('success'))
    <div class="alert alert-success">{{ Session::get('success')}}</div>
    @endif
    @if ($errors->any())
    <ul class="alert alert-danger">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama:</label>
        <div class="col-sm-10">
        <input type="text" class="form-control" id="nama" name="name" required>
        </div>
    </div>

    
    <div class="mb-3 row">
        <label for="email" class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-10">
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="password" class="col-sm-2 col-form-label">Password</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
    </div>

    <div class="mb-3 row">
        <label for="role" class="col-sm-2 col-form-label">Tipe Pengguna:</label>
        <div class="col-sm-10">
        <select class="form-select" id="role" name="role" required>
            <option selected disabled hidden>Pilih</option>
            <option value="Admin">Admin</option>
            <option value="User">User</option>
        </select>
        <button type="submit" class="btn btn-primary mt-3">Tambah</button>
        </div>
    </div>
    </form>
@endsection