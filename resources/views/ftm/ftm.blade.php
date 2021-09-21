@extends('layouts2.master')
@section('breadcrumb')
    <li><span>STO - FTM OA</span></li>
@endsection
@section('title','FTM')
@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data FTM OA - STO {{$sto->nama_sto}}</h4>

                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahftm">Tambah</button>
                </div>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Rack FTM</th>
                                    <th scope="col">No. Rack</th>
                                    <th scope="col">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ftms as $ftm)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$ftm->nama_ftm}}</td>
                                    <td>{{$ftm->no_rak}}</td>
                                    <td>
                                        <a href="{{route('getPanelFtmOa',['sto_id'=>$sto->id,'ftm_oa_id'=>$ftm->id])}}" class="btn btn-primary">Buka</a>
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
<div class="modal fade" id="tambahftm" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeFtmOa',$sto->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Rack</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_ftm" value="" class="form-control" placeholder="Masukkan Nama Rack FTM OA">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. Rack</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="no_rak" value="" class="form-control" placeholder="Masukkan Nomor Rak">
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

<div class="modal fade" id="editftm" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateFtmOa',$sto->id)}}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Rack</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_ftm" value="" class="form-control" placeholder="Masukkan Nama Rack FTM OA">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. Rack</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="no_rak" value="" class="form-control" placeholder="Masukkan Nomor Rak">
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
        $(".edit-ftm").click(function (e) {
            e.preventDefault();
            const ftm_id = $(this).data('ftm_id')
            const nama_ftm = $(this).data('nama_ftm')
            const alamat = $(this).data('alamat')

            $("#edit_ftm_id").val(ftm_id);
            $("#edit_nama_ftm").val(nama_ftm);
            $("#edit_alamat").html(alamat);
        });
    });

    $('.hapus-ftm').click(function(){
			const ftm_id = $(this).data('ftm_id');

            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/dashboard/ftm/delete/"+ftm_id;
                }
            });


		});
</script>
@endsection
