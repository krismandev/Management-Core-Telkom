@extends('layouts2.master')
@section('title','STO - '.$sto->nama_sto)
@section('header')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@stop
@section('breadcrumb')
    <li><a href="{{route('getSTO')}}">STO</a></li>
    <li><span>{{$sto->nama_sto}}</span></li>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 mt-5">
            <div class="card">
                <div class="card-header">
                    <h2>STO - {{$sto->nama_sto}}</h2>
                    <p>{{$sto->alamat}}</p>
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="{{route("getOlt",$sto->id)}}" class="btn btn-info" style="height: 80px; padding: 20px; font-size: 25px" >OLT</a>
                                </div>
                            </div>
                            <div class="col-md-6 mt-5 mb-3">
                                <div class="card">
                                    <a href="{{route("getFtmOa",$sto->id)}}" class="btn btn-info" style="height: 80px; padding: 20px; font-size: 25px" >FTM</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h4 class="header-title">Feeder  STO {{$sto->nama_sto}}</h4>
                    <div class="single-table mt-3">
                        <div class="table-responsive">
                            <table class="table" id="data_feeders_reguler">
                                <thead class="text-uppercase bg-dark">
                                <tr class="text-white">
                                    <th scope="col">#</th>
                                    <th scope="col"> Nama Feeder</th>
                                    <th scope="col">STO</th>
                                    <th scope="col">Kapasitas</th>
                                    <th scope="col">Assign</th>
                                    <th scope="col">Unassign</th>
                                    {{-- <th scope="col">Core Used</th> --}}
                                    {{-- <th scope="col">Core Available</th> --}}
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
                                        <td>{{$feeder->core_assigned()}}</td>
                                        <td>{{$feeder->core_unasigned()}}</td>
                                        {{-- <td>{{$feeder->core_used}}</td> --}}
                                        {{-- <td>{{$feeder->core_available}}</td> --}}
                                        <td style="text-align: center;">
                                            <a href="{{route('showFeeder',$feeder->id)}}" class="btn btn-primary">Buka</a>
                                            <a href="#" class="btn btn-warning edit-feeder" data-toggle="modal" data-target="#editfeeder" data-feeder_id="{{$feeder->id}}" data-nama_feeder="{{$feeder->nama_feeder}}">Edit</a>
                                            {{--                                        <a href="#" class="btn btn-danger hapus-feeder" data-feeder_id="{{$feeder->id}}">Hapus</a>--}}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <h2>Pilih STO</h2> --}}

                </div>
            </div>
        </div>
    </div>

@endsection

@section('linkfooter')
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
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
                                <input type="hidden" name="sto_id_value" id="sto_id_value" value="">
                                <input type="text" name="nama_feeder" value="" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <span>Rak FTM</span>
                            </div>
                            <div class="col-md-12">
                                <select name="ftm_oa_id" id="" class="form-control" required>
                                    <option value="">Pilih Rak FTM-OA</option>
                                    @if(isset($sto_selected))
                                        @foreach ($ftm_oas as $ftom_oa)
                                            <option value="{{$ftom_oa->id}}">{{$ftom_oa->nama_ftm}}</option>
                                        @endforeach
                                    @endif
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
            $('#data_feeders_reguler').DataTable();
            $(".edit-feeder").click(function (e) {
                e.preventDefault();
                const feeder_id = $(this).data('feeder_id')
                const nama_feeder = $(this).data('nama_feeder')

                // alert(nama_feeder);
                $("#feeder_id_update").val(feeder_id);
                $("#nama_feeder_update").val(nama_feeder);
            });

            $(".add-feeder").click(function (e) {
                e.preventDefault();
                const sto_id = $(this).data('sto_id')
                $("#sto_id_value").val(sto_id);
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

            $("select[name='sto_id']").change(function(e){
                var sto_id = $(this).val();
                var url = "/dashboard/feeder/"+sto_id;
                window.location.href = url;
            })
        });


    </script>
@endsection
