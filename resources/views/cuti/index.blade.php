@extends('layouts.app')

@section('content')
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Cuti
</button>
<h4 class="pt-3 pb-3">Daftar Cuti</h4>
<table id="myTable" class="table table-dark table-striped">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Cuti</th>
            <th scope="col">Lama Cuti</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Karyawan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($data as $cuti)

        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>
                {{ date("d F Y", strtotime($cuti->tanggal_cuti))  }}
            </td>
            <td>
                {{ $cuti->lama_cuti }}
            </td>
            <td>{{ $cuti->keterangan }}</td>
            <td>{{ $cuti->karyawan->nama }}</td>
            <td>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#modalEdit" onclick="getEditForm({{$cuti->id}})">
                    Edit
                </button>
                <form action="{{ route('cuti.destroy', $cuti->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="btn btn-danger" onclick="if(!confirm('Apakah Anda Yakin Ingin Menghapus Cuti')) return false;">DELETE</button>
                </form>

            </td>

        </tr>
        @endforeach
    </tbody>
</table>

{{-- Modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Cuti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('cuti.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="" class="col-form-label">Tanggal Cuti</label>
                    <input type="date" class="form-control" name="tanggal_cuti">
                    <label for="" class="col-form-label">Lama Cuti</label>
                    <input type="number" class="form-control" name="lama_cuti" required>
                    <label for="" class="col-form-label">Keterangan</label>
                    <textarea class="form-control" name="keterangan"></textarea>
                    <label for="" class="col-form-label">Karyawan</label>
                    <select name="karyawan" class="form-control">
                        @foreach ($karyawan as $item)
                        <option value="{{ $item->nomor_induk }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

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
                , url: '{{ route('cuti.getEditForm') }}'
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
