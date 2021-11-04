@extends('layouts2.master')
@section('title','STO')
@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@stop
@section('breadcrumb')
    <li><span>STO</span></li>
@endsection
@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data STO</h4>

                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahsto">Tambah</button>
                </div>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table text-center" id="data_stos_reguler">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama STO</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stos as $sto)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$sto->nama_sto}}</td>
                                    <td>{{$sto->alamat}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit-sto" data-toggle="modal" data-target="#editsto" data-sto_id="{{$sto->id}}" data-nama_sto="{{$sto->nama_sto}}" data-alamat="{{$sto->alamat}}">Edit</a>
{{--                                        <a href="{{route('getOlt',$sto->id)}}" class="btn btn-primary">OLT</a>--}}
{{--                                        <a href="{{route('getFtmOa',$sto->id)}}" class="btn btn-primary">FTM</a>--}}
                                        <a href="{{route('showSTO',$sto->id)}}" class="btn btn-primary">Buka</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('linkfooter')
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<div class="modal fade" id="tambahsto" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeSTO')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama STO</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_sto" value="" class="form-control" placeholder="Masukkan nama STO">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Alamat</span>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="4" name="alamat"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>

<div class="modal fade" id="editsto" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateSTO')}}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama STO</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" id="edit_sto_id" name="sto_id">
                        <input type="text" name="nama_sto" id="edit_nama_sto" value="" class="form-control" placeholder="Masukkan nama STO Edit">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Alamat</span>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="4" name="alamat" id="edit_alamat"></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#data_stos_reguler').DataTable();
        $(".edit-sto").click(function (e) {
            e.preventDefault();
            const sto_id = $(this).data('sto_id')
            const nama_sto = $(this).data('nama_sto')
            const alamat = $(this).data('alamat')

            $("#edit_sto_id").val(sto_id);
            $("#edit_nama_sto").val(nama_sto);
            $("#edit_alamat").html(alamat);
        });
    });

    $('.hapus-sto').click(function(){
			const sto_id = $(this).data('sto_id');

            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/dashboard/sto/delete/"+sto_id;
                }
            });


		});
</script>
@endsection
