<form role="form" action="{{ route('karyawan.update', $data->nomor_induk)}}" method='POST'>
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Karyawan {{$data->nomor_induk}}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <label for="" class="col-form-label">Nama Karyawan</label>
            <input type="text" class="form-control" name="nama" value="{{ $data->nama }}" required>
            <label for="" class="col-form-label">Alamat</label>
            <textarea class="form-control" name="alamat">{{ $data->alamat }}</textarea>
            <label for="" class="col-form-label">Tanggal Lahir</label>
            <input type="date" class="form-control" value="{{ $data->tanggal_lahir }}" name='tanggal_lahir'>
            <label for="" class="col-form-label">Tanggal Bergabung</label>
            <input type="date" class="form-control" value="{{ $data->tanggal_bergabung }}" name="tanggal_bergabung">
        </div>
        <div class="modal-footer">
            <div class="col-md-offset-3 col-md-9">
                <button type="Submit" class="btn btn-info">Submit</button>
                <a href="{{url('supplier')}}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
            </div>
        </div>
    </div>
</form>