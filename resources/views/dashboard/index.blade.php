@extends('templates.base')
@section('title', 'Daftar User')

@section('content')
    <h1 class="my-4">Daftar User</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Email</th>
                <th scope="col">Nama</th>
                <th scope="col">Role</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role == 1 ? 'User' : 'Admin' }}</td>
                    <td>
                        <a href="{{ route('aspiration.show', ['id' => 1]) }}"
                            class="badge text-decoration-none text-bg-info">Detail</a>
                        <a href="" class="badge text-decoration-none text-bg-success text-white">Update</a>
                        <a href="" class="badge text-decoration-none text-bg-danger text-white">Hapus</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
