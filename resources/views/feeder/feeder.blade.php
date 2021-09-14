@extends('layouts2.master')
@section('title','Feeder')
@section('breadcrumb')
    <li><span>Feeder</span></li>
@endsection
@section('content')

<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data Feeder</h4>

                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahfeeder">Tambah</button>
                </div>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col"> Nama Feeder</th>
                                    <th scope="col">STO</th>
                                    <th scope="col">Kapasitas</th>
                                    <th scope="col">Assign</th>
                                    <th scope="col">Unassign</th>
                                    <th scope="col">Core Used</th>
                                    <th scope="col">Core Available</th>
                                    <th scope="col" style="text-align: center;">Aksi</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feeders as $feeder)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$feeder->nama_feeder}}</td>
                                    <td>{{$feeder->sto->nama_sto}}</td>
                                    <td>{{$feeder->kapasitas}}</td>
                                    <td>{{$feeder->assign}}</td>
                                    <td>{{$feeder->unassign}}</td>
                                    <td>{{$feeder->core_used}}</td>
                                    <td>{{$feeder->core_available}}</td>
                                    <td style="text-align: center;">
                                        <a href="{{route('showFeeder',$feeder->id)}}" class="btn btn-primary hapus-feeder">Buka</a>
                                        <a href="#" class="btn btn-warning edit-feeder" data-toggle="modal" data-target="#editfeeder" data-feeder_id="{{$feeder->id}}" data-nama_feeder="{{$feeder->nama_feeder}}">Edit</a>
                                        <a href="#" class="btn btn-danger hapus-feeder" data-feeder_id="{{$feeder->id}}">Hapus</a>
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
<div class="modal fade" id="tambahfeeder" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeFeeder')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Feeder</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_feeder" value="" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>STO</span>
                    </div>
                    <div class="col-md-12">
                        <select name="sto_id" id="" class="form-control">
                            <option value="">Pilih STO</option>
                            @foreach ($stos as $sto)
                                <option value="{{$sto->id}}">{{$sto->nama_sto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Kapasitas</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="kapasitas" value="" class="form-control" placeholder="">
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

<div class="modal fade" id="editfeeder" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateFeeder')}}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Feeder</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="feeder_id" id="feeder_id_update" value="">
                        <input type="text" name="nama_feeder" value="" id="nama_feeder_update" class="form-control">
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
        $(".edit-feeder").click(function (e) {
            e.preventDefault();
            const feeder_id = $(this).data('feeder_id')
            const nama_feeder = $(this).data('nama_feeder')

            // alert(nama_feeder);
            $("#feeder_id_update").val(feeder_id);
            $("#nama_feeder_update").val(nama_feeder);
        });
    });

    $('.hapus-feeder').click(function(){
			const feeder_id = $(this).data('feeder_id');

            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/dashboard/feeder/delete/"+feeder_id;
                }
            });


		});
</script>
@endsection
