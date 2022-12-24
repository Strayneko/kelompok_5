@extends('templates.base')
@section('title', 'Daftar Aspirasi')

@section('content')
    <h1 class="my-4">Daftar Aspirasi</h1>
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
        // delete aspiration function
        function deleteAspiration(id) {
            const konfirm = confirm('apakah anda yakin?')
            if (!konfirm) return;
            fetch(`http://127.0.0.1:8000/api/aspiration/${id}/delete`, {
                    method: 'POST'
                }).then(res => res.json())
                .then(res => {
                    alert(res.message)
                    location.href = ""
                }).catch(err => alert(err))
        }

        // when DOM is fully loaded
        // do the logic
        document.addEventListener('DOMContentLoaded', () => {
            fetch('http://127.0.0.1:8000/api/aspiration').then(res => res.json())
                .then(res => {
                    let html = ``
                    let i = 1;
                    for (let aspiration of res.data) {
                        html += `<tr>
                    <td>${i++}</td>
                    <td>${aspiration.title}</td>
                    <td>${aspiration.status == 0 ? '<span class="text-danger">Belum dibaca</span>' : '<span class="text-success">Sudah dibaca</span>'}</td>
                    <td>
                        <a href="http://127.0.0.1:8000/aspiration/${aspiration.id}"
                            class="badge text-decoration-none text-bg-info">Detail</a>
                        <a href="#" onclick="deleteAspiration(${aspiration.id})" class="badge text-decoration-none text-bg-danger text-white">Hapus</a>
                    </td>
                </tr>`
                    }

                    $('#aspirations').html(html)
                }).catch(err => alert);

        })
    </script>
@endsection
