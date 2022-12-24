@extends('templates.base')
@section('title', 'Daftar Aspirasi')

@section('content')
  <table class="table table-bordered table-striped table-hover">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Judul</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody id="aspirations">
    </tbody>
  </table>
  <a href="{{ route('aspiration.create') }}">Tambah Aspirasi</a>

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
            </tr>`
                }

                $('#aspirations').html(html)
            });

        })
    </script>
@endsection
