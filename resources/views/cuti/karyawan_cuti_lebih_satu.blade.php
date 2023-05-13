@extends('layouts.app')

@section('content')
<h4 class="pt-3 pb-3">Daftar Karyawan Cuti Lebih Dari 1</h4>
<table id="myTable" class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Karyawan</th>
            <th scope="col">Tanggal Cuti</th>
            <th scope="col">Keterangan</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $karyawan)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{$karyawan->nama}}
            </td>
            <td>
                <ul>
                    @foreach ($karyawan->cutis as $cuti)
                    <li>

                        {{ date("d F Y", strtotime($cuti->tanggal_cuti)) }}
                    </li>

                    @endforeach

                </ul>

            </td>
            <td>
                <ul>
                    @foreach ($karyawan->cutis as $cuti)
                    <li>

                        {{ $cuti->keterangan}}
                    </li>

                    @endforeach

                </ul>

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
