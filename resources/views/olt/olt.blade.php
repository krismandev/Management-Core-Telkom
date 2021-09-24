@extends('layouts2.master')
@section('breadcrumb')
    <li><a href="{{route('getSTO')}}">STO - {{$sto->nama_sto}}</a></li>
    <li><span>Data OLT</span></li>

@endsection
@section('title','OLT')
@section('content')
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data OLT</h4>

                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambaholt">Tambah</button>
                </div>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table text-center">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col">Hostname</th>
                                    <th scope="col">IP</th>
                                    <th scope="col">Merk</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Frame</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($olts as $olt)
                                <tr>
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$olt->hostname}}</td>
                                    <td>{{$olt->ip}}</td>
                                    <td>{{$olt->merk}}</td>
                                    <td>{{$olt->type}}</td>
                                    <td>{{$olt->no_frame}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit-olt"
                                        data-olt_id="{{$olt->id}}"
                                        data-hostname="{{$olt->hostname}}"
                                        data-ip="{{$olt->ip}}"
                                        data-merk="{{$olt->merk}}"
                                        data-type="{{$olt->type}}"
                                        data-no_frame="{{$olt->no_frame}}" data-toggle="modal" data-target="#editolt">Edit</a>
                                    </td>
                                    {{-- <td>
                                        <a href="#" class="btn btn-warning edit-olt" data-toggle="modal" data-target="#editolt" data-olt_id="{{$olt->id}}" data-nama_olt="{{$olt->nama_olt}}" data-alamat="{{$olt->alamat}}">Edit</a>
                                        <a href="#" class="btn btn-danger hapus-olt" data-olt_id="{{$olt->id}}">Hapus</a>
                                        <a href="{{route('getOlt',$olt->id)}}" class="btn btn-primary" data-olt_id="{{$olt->id}}">Buka</a>
                                    </td> --}}
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
<div class="modal fade" id="tambaholt" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeOlt',$sto->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Hostname</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="hostname" value="" class="form-control" placeholder="Masukkan Hostname">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>IP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="ip" value="" class="form-control" placeholder="Masukkan IP OLT">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Merk</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="merk" value="" class="form-control" placeholder="Masukan merk">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Tipe</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="type" value="" class="form-control" placeholder="Masukan Tipe">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. Frame</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="no_frame" value="" class="form-control" placeholder="Masukan No. Frame">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Jumlah Slot</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="jumlah_slot" value="" class="form-control" placeholder="Masukan Jumlah Slot OLT">
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

<div class="modal fade" id="editolt" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateOlt',$sto->id)}}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Hostname</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="hostname" id="edit_hostname" value="" class="form-control" placeholder="Masukkan Hostname">
                        <input type="hidden" name="olt_id" id="edit_olt_id" value="" class="form-control" placeholder="Masukkan Hostname">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>IP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="ip" id="edit_ip" value="" class="form-control" placeholder="Masukkan IP OLT">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Merk</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="merk" id="edit_merk" value="" class="form-control" placeholder="Masukan merk">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Tipe</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="type" id="edit_type" value="" class="form-control" placeholder="Masukan Tipe">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. Frame</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="no_frame" id="edit_no_frame" value="" class="form-control" placeholder="Masukan No. Frame">
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
        $(".edit-olt").click(function (e) {
            e.preventDefault();
            const olt_id = $(this).data('olt_id')
            const hostname = $(this).data('hostname')
            const ip = $(this).data('ip')
            const merk = $(this).data('merk')
            const type = $(this).data('type')
            const no_frame = $(this).data('no_frame')


            $("#edit_olt_id").val(olt_id);
            $("#edit_hostname").val(hostname);
            $("#edit_ip").val(ip);
            $("#edit_merk").val(merk);
            $("#edit_type").val(type);
            $("#edit_no_frame").val(no_frame);

        });
    });

    $('.hapus-olt').click(function(){
			const olt_id = $(this).data('olt_id');

            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/dashboard/olt/delete/"+olt_id;
                }
            });


		});
</script>
@endsection
