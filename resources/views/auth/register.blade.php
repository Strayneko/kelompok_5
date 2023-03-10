@extends('templates.base')

@section('title', 'Registrasi User')
@section('content')
    <form method="post" id="register_form" class="col-md-4" enctype="multipart/form-data" action="{{ route('auth.register') }}">
        @csrf
        <h1 class="my-4">Registrasi User</h1>
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control" name="name" id="name" required autofocus>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" name="password" id="password" required>
        </div>
        <div class="mb-3">
            <label for="birth_date" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" name="birth_date" id="birth_date" required>
        </div>

        <div class="mb-3">
            <label for="gender" class="form-label">Jenis Kelamin</label>
            <select class="form-select" id="gender" name="gender" required>
                <option value="0">Perempuan</option>
                <option value="1">Laki - Laki</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input class="form-control" type="file" id="image" name="image" accept="image/*" required>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $("#register_form").on('submit', (e) => {
                e.preventDefault();
                const name = $('#name').val();
                const email = $('#email').val()
                const password = $("#password").val()
                const birth_date = $("#birth_date").val()
                const gender = $('#gender option:selected').val()
                const image = $("#image").prop('files')[0]
                const fd = new FormData();
                fd.append('email', email);
                fd.append('password', password);
                fd.append('gender', gender);
                fd.append('birth_date', birth_date);
                fd.append('image', image);
                fd.append('name', name);
                fetch('http://127.0.0.1:8000/api/auth/register', {
                    method: 'POST',
                    body: fd
                }).then(res => res.json()).then(res => {
                    if (!res.status) {
                        alert(res.message);
                        return;
                    }
                    alert(res.message)
                    location.href = "http://127.0.0.1:8000/auth"
                })

            })

        })
    </script>
@endsection
