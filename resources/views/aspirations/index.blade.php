@extends('templates')
@section('title', 'Daftar Aspirasi')

@section('content')

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
            <tr>
                <th scope="row">1</th>
                <td>Contoh Judul</td>
                <td>Belum Dibaca</td>
                <td>
                    <a href="{{ route('aspiration.show', ['id' => 1]) }}" class="badge text-bg-info">Detail</a>
                    <a href="" class="badge text-bg-success text-white">Update</a>
                    <a href="" class="badge text-bg-danger text-white">Hapus</a>
                </td>
            </tr>
        </tbody>
    </table>


@endsection
