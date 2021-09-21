@extends('layouts2.master')
@section('breadcrumb')
    <li><span>STO {{$sto->nama_sto}} / FTM OA {{$ftm_oa->nama_ftm}}</span></li>
@endsection
@section('title',$ftm_oa->nama_ftm)
@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data Panel  {{$ftm_oa->nama_ftm}}</h4>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">Nomor Panel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($panels as $panel)
                                <tr>
                                    <td>
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Panel {{$panel->no_panel}}</a>
                                        {{-- <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                                            Dropdown button
                                        </button> --}}
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6 mt-5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Accordion 1</h4>
                            <div id="accordion5" class="according accordion-s2 gradiant-bg">
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion51" aria-expanded="false">Collapsible Group
                                            Item #1</a>
                                    </div>
                                    <div id="accordion51" class="collapse" data-parent="#accordion5" style="">
                                        <div class="card-body">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="card-link collapsed" data-toggle="collapse" href="#accordion52" aria-expanded="false">Collapsible
                                            Group Item #2</a>
                                    </div>
                                    <div id="accordion52" class="collapse" data-parent="#accordion5" style="">
                                        <div class="card-body">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        <a class="collapsed card-link" data-toggle="collapse" href="#accordion53">Collapsible
                                            Group Item #3</a>
                                    </div>
                                    <div id="accordion53" class="collapse" data-parent="#accordion5">
                                        <div class="card-body">
                                            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo eaque porro alias assumenda accusamus incidunt odio molestiae maxime quo atque in et quaerat, vel unde aliquam aperiam quidem consectetur omnis dicta officiis? Dolorum, error dolorem!
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        <form class="" action="#" method="post" enctype="multipart/form-data">
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
        <form class="" action="#" method="post" enctype="multipart/form-data">
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
