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
        </tbody>
    </table>

    <script>
        function deleteUser(id) {
            const konfirm = confirm('Apakah anda ingin menjadikan user ini sebagai admin?')
            if (!konfirm) return
            fetch(`http://127.0.0.1:8000/api/dashboard/${id}/delete`, {
                    method: 'POST'
                })
                .then(res => res.json())
                .then(res => {
                        // get id from url path
                        let id = location.href.split('/')
                        id = id[id.length - 1]
                        if (!res.status) {
                            alert(res.message)
                            return;
                        }
                        alert(res.message);
                        location.href = "http://127.0.0.1:8000/dashboard"
                    }

                );
        }

        function makeAdmin(id) {
            const konfirm = confirm('Apakah anda yakin?')
            if (!konfirm) return
            fetch(`http://127.0.0.1:8000/api/dashboard/${id}/makeAdmin`, {
                    method: 'POST'
                })
                .then(res => res.json())
                .then(res => {
                        // get id from url path
                        let id = location.href.split('/')
                        id = id[id.length - 1]
                        if (!res.status) {
                            alert(res.message)
                            return;
                        }
                        alert(res.message);
                        location.href = "http://127.0.0.1:8000/dashboard"
                    }

                );
        }
        document.addEventListener('DOMContentLoaded', () => {



            fetch('http://127.0.0.1:8000/api/dashboard')
                .then(res => res.json())
                .then(res => {
                    let html = ``
                    let i = 1;
                    for (let user of res.data) {
                        html += `<tr>
                    <td>${i++}</td>
                    <td>${user.email}</td>
                    <td>${user.name}</td>
                    <td>${user.role_id == 1 ? 'User' : 'Admin' }</td>
                    <td>
                        <a href="#"
                        onclick="makeAdmin(${user.id})"
                            class="badge text-decoration-none text-bg-info">Jadikan Admin</a>
                        <a href="#" onclick="deleteUser(${user.id})" class="badge text-decoration-none text-bg-danger text-white">Hapus</a>
                    </td>
                </tr>`
                    }

                    $('#user_list').html(html)
                });
        });
    </script>
@endsection
