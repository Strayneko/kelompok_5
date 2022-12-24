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
        <tbody id="user_list">
            {{-- @foreach ($users as $user)
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
            @endforeach --}}
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            fetch('http://127.0.0.1:8000/api/dashboard').then(res => res.json()).then(res => {
                let html = ``
                let i = 1;
                for (let user of res.data) {
                    html += `  <tr>
                    <td>${i++}</td>
                    <td>${user.email}</td>
                    <td>${user.name}</td>
                    <td>${user.role == 1 ? 'User' : 'Admin' }</td>
                    <td>
                        <a href=""
                            class="badge text-decoration-none text-bg-info">Detail</a>
                        <a href="" class="badge text-decoration-none text-bg-success text-white">Update</a>
                        <a href="" class="badge text-decoration-none text-bg-danger text-white">Hapus</a>
                    </td>
                </tr>`
                }

                $('#user_list').html(html)
            });

        })
    </script>
@endsection
