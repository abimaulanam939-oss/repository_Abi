@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Data Anggota</h2>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Alamat</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach($anggotas as $key => $anggota)
            <tr>
                <td>{{ $key+1 }}</td>
                <td>{{ $anggota->nama }}</td>
                <td>{{ $anggota->email }}</td>
                <td>{{ $anggota->alamat }}</td>
                <td>{{ $anggota->no_hp }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
