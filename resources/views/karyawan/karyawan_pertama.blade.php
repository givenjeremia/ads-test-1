@extends('layouts.app')

@section('content')
<h4 class="pt-3 pb-3">Daftar karyawan Pertama</h4>
<table id="myTable" class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nomor Induk</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Tanggal Bergabung</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $karyawan)

        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{$karyawan->nomor_induk}}
            </td>
            <td>
                {{ $karyawan->nama }}
            </td>
            <td>{{ $karyawan->alamat }}</td>
            <td>{{ $karyawan->tanggal_lahir }}</td>
            <td>{{ $karyawan->tanggal_bergabung }}</td>
            <td>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="getEditForm('{{$karyawan->nomor_induk}}')">
                    Edit
                </button>
                <form action="{{ route('karyawan.destroy', $karyawan->nomor_induk) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="if(!confirm('Apakah Anda Yakin Ingin Menghapus karyawan')) return false;">DELETE</button>
                </form>

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

{{-- modal edit --}}
<div class="modal fade" id="modalEdit" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modalContent">

        </div>
    </div>
</div>
@endsection


@section('js')
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });

    function getEditForm(id) {
        $.ajax({
                type: 'POST'
                , url: '{{ route('karyawan.getEditForm') }}'
                , data: {
                    '_token': '<?php echo csrf_token(); ?>'
                    , 'id': id
                }
                , success: function(data) {
                    $('#modalContent').html(data.msg)
                }
            },

        );
    }

  

</script>

@endsection
