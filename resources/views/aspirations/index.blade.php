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
        <tbody>
            @foreach ($aspirasi as $aspiration)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $aspiration->title }}</td>
                    <td>{{ $aspiration->status }}</td>
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
