<!-- resources/views/medicine/stock.blade.php -->

<!-- Extends template -->
@extends('layouts.template')

<!-- Section content -->
@section('content')
    <div id="msg-success"></div>

<!-- Table medicine stock -->
<style>
    .low-stock {
        background-color: red;
        color: white;
    }
</style>

<table class="table table-striped table-bordered table-hover">
    <thead>
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Stok</th>   
        <th class="text-center">Aksi</th>
    </tr>
    </thead>
    <tbody>
    @php $no = 1; @endphp
    @foreach ($medicine as $item)
        <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $item['name'] }}</td>
        <td class="{{ $item['stock'] <= 3 ? 'low-stock' : '' }}"> {{ $item['stock'] }}</td>
        <td class="d-flex justify-content-center">
            <div onclick="edit({{$item['id']}})" class="btn btn-primary me-3" style="cursor: pointer">Tambah Stock</div>
        </td>
        </tr>
    @endforeach
    </tbody>
</table>

<!-- resources/views/medicine/stock.blade.php -->

<!-- Modal edit stock -->
<div class="modal" tabindex="-1" id="edit-stock">
<div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">Ubah Data Stock</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>

    <!-- Form edit stock -->
    <form method="POST" id="form-stock">
        @csrf

        <div class="modal-body">
        <div id="msg"></div>
        <input type="hidden" name="id" id="id">

        <div class="form-group">
            <label for="name" class="form-label">Masa Obat</label>
            <input type="text" class="form-control" id="name" name="name" disabled>
        </div>

        <div class="form-group">
            <label for="stock" class="form-label">Stock Obat</label>
            <input type="number" class="form-control" id="stock" name="stock">
        </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
    </div>
</div>
</div>
@endsection

@push('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });
    
    function edit(id) {
        var url = "{{ route('medicine.stock.edit', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
        type: "GET",
        url: url,
        dataType: 'json',
        success: function(res) {
            $('#edit-stock-modal').show();
            $('#id').val(res.id);
            $('#name').val(res.name);
            $('#stock').val(res.stock);
        }
        });
    }
    
    $('#form-stock').submit(function(e){
    e.preventDefault();
    var id = $('#id').val();
    var urlForm = "{{ route('medicine.stock.update', ':id') }}";
    urlForm = urlForm.replace(':id', id);
    var data = {
        stock: $('#stock').val()
    };
    $.ajax({
        type: 'PATCH',
        url: urlForm,
        data: data,
        cache: false,
        success: (data) => {
        $("#edit-stock").modal('hide');
        sessionStorage.reloadAfterPageLoad = true;
        window.location.reload();
        },
        error: function(data) {
        $('#msg').attr("class", "alert alert-danger");
        $('#msg').text(data.responseJSON.message);
        }
    });
    });
    
    $(function(){
    if (sessionStorage.reloadAfterPageLoad) {
        $('#msg-success').attr("class", "alert alert-success");
        $('#msg-success').text("Berhasil menambahkan data stock!");
        sessionStorage.clear();
    }
    });
    
    </script>
    
    
@endpush