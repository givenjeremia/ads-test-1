<form role="form" action="{{ route('cuti.update', $data->id)}}" method='POST'>
    @csrf
    @method('PUT')
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Cuti</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
        <div class="form-body">
            <label for="" class="col-form-label">Tanggal Cuti</label>
            <input type="date" class="form-control" name="tanggal_cuti" value="{{ $data->tanggal_cuti }}">
            <label for="" class="col-form-label">Lama Cuti</label>
            <input type="number" class="form-control" name="lama_cuti" value="{{ $data->lama_cuti }}" required>
            <label for="" class="col-form-label">Keterangan</label>
            <textarea class="form-control" name="keterangan">{{ $data->keterangan }}</textarea>
            <label for="" class="col-form-label">Karyawan</label>
            <select name="karyawan" class="form-control">
                @foreach ($karyawan as $item)
                <option value="{{ $item->nomor_induk }}" {{ $item->nomor_induk == $data->nomor_induk ? 'selected' : '' }}>{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="modal-footer">
            <div class="col-md-offset-3 col-md-9">
                <button type="Submit" class="btn btn-info">Submit</button>
                <a href="{{url('supplier')}}" class="btn btn-default" data-dismiss='modal'>Cancel</a>
            </div>
        </div>
    </div>
</form>
