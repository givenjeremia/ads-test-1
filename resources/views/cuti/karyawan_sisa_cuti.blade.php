@extends('layouts.app')

@section('content')
<h4 class="pt-3 pb-3">Daftar Sisa Cuti Karyawan</h4>
<table id="myTable" class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nomor Induk</th>
            <th scope="col">Nama</th>
            <th scope="col">Sisa Cuti</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $karyawan)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{$karyawan['nomor_induk']}}
            </td>
            <td>
                {{$karyawan['nama']}}
            </td>
            <td>
                {{$karyawan['sisa_cuti']}}
            </td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

</script>

@endsection
