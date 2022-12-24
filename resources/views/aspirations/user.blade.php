@extends('templates.base')
@section('title', 'Daftar Aspirasi')

@section('content')
    <h1 class="my-4">Daftar Apirasiku</h1>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Status</th>
                <th scope="col">Opsi</th>
            </tr>
        </thead>
        <tbody id="aspirations">
        </tbody>
    </table>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            let id = location.href.split('/')
            id = id[id.length - 1]
            fetch(`http://127.0.0.1:8000/api/aspiration/dashboard`, {
                method: "POST",
                body: {
                    id
                }
            }).then(res => res.json()).then(res => {
                if (!res.status) $('#aspirations').html(`
                    <tr>
                    <td class="text-center" colspan="4">${res.message}</td>    
                    </tr>
                `)
                let html = ``
                let i = 1;
                for (let aspiration of res.data) {
                    html += `<tr>
                <td>${i++}</td>
                <td>${aspiration.title}</td>
                <td>${aspiration.status == 0 ? 'Belum dibaca' : 'Sudah dibaca'}</td>
                <td>
                    <a href="http://127.0.0.1:8000/aspiration/${aspiration.id}"
                        class="badge text-decoration-none text-bg-info">Detail</a>
                    <a href="" class="badge text-decoration-none text-bg-success text-white">Update</a>
                    <a href="" class="badge text-decoration-none text-bg-danger text-white">Hapus</a>
                </td>
            </tr>`
                }

                $('#aspirations').html(html)
            });

        })
    </script>
@endsection
