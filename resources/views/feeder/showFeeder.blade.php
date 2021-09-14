@extends('layouts2.master')
@section('title','Feeder')
@section('breadcrumb')
    <li><span>Feeder</span></li>
    <li><span>{{$feeder->nama_feeder}}</span></li>
@endsection
@section('content')
<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-header">
            <h2>{{$feeder->nama_feeder}}</h2>
            @if(isset($odc))
                <h3>{{$odc->nama_odc}}</h3>
            @else
                <h3>All ODC</h3>
            @endif
            <div class="pull-right">
                <select name="odc_id" id="" class="form-control">
                    @if(isset($odc))
                        <option value="{{$odc->id}}" selected>{{$odc->nama_odc}}</option>
                    @else
                        <option value="" selected>All ODC</option>
                    @endif
                    @foreach ($data_odcs as $data_odc)
                    <option value="{{$data_odc->id}}">{{$data_odc->nama_odc}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="card-body">
            <h4 class="header-title">Core</h4>


            {{-- <div class="row mt-2">
                @foreach ($cores as $core)
                <div class="col-lg-3">
                    <div class="col-lg-12">
                        <div class="col-lg-2">
                            {{$core->no_core_feeder}}
                        </div>
                        <div class="col-lg-10">
                        @foreach ($core as $core_split)

                                <button class="btn btn-info"></button>
                        @foreach ($core as $core_split)
                        </div>
                    </div>
                </div>
                @endforeach
            </div> --}}
            <div class="row mt-2">
                @foreach ($cores as $core)

                    <div class="col-lg-3 mt-3">
                        <span>{{$core->no_core_feeder}}</span>
                        @foreach ($core->core_splited as $core_split)
                        @if($core_split->status == 'idle')
                        <button class="btn btn-secondary assign-this" data-toggle="modal" data-target="#assign-this" data-core_splited_id="{{$core_split->id}}"></button>
                        {{-- @elseif ($core_split->odp != null)
                        <button class="btn btn-success edit-assign-this-to-odp"
                        data-toggle="modal" data-target="#edit-assign-this"
                        ></button> --}}
                        @elseif($core_split->status == 'assigned')
                            @if ($core_split->odp != null)
                            <button class="btn btn-success edit-assign-this-with-odp"
                                data-toggle="modal" data-target="#edit-assign-this-with-odp"
                                data-core_splited_id="{{$core_split->id}}"
                                data-core_id="{{$core_split->core_id}}"
                                data-panel_odc_in="{{$core_split->panel_odc_in}}"
                                data-core_odc_in="{{$core_split->core_odc_in}}"
                                data-spliter="{{$core_split->spliter}}"
                                data-panel_odc_out="{{$core_split->panel_odc_out}}"
                                data-port_odc_out="{{$core_split->port_odc_out}}"
                                data-dist_odc_out="{{$core_split->dist_odc_out}}"
                                data-odp_id="{{$core_split->odp->id}}"
                                data-no_odp="{{$core_split->odp->no_odp}}"
                                data-nama_frame_odp="{{$core_split->odp->nama_frame_odp}}"
                                data-nama_odp="{{$core_split->odp->nama_odp}}"
                                data-long_odp="{{$core_split->odp->long}}"
                                data-lat_odp="{{$core_split->odp->lat}}">
                            </button>
                            @else
                            <button class="btn btn-success edit-assign-this"
                                data-toggle="modal" data-target="#edit-assign-this"
                                data-core_splited_id="{{$core_split->id}}"
                                data-core_id="{{$core_split->core_id}}"
                                data-panel_odc_in="{{$core_split->panel_odc_in}}"
                                data-core_odc_in="{{$core_split->core_odc_in}}"
                                data-spliter="{{$core_split->spliter}}"
                                data-panel_odc_out="{{$core_split->panel_odc_out}}"
                                data-port_odc_out="{{$core_split->port_odc_out}}"
                                data-dist_odc_out="{{$core_split->dist_odc_out}}">
                            </button>
                            @endif
                        @endif
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
@section('linkfooter')
<div class="modal fade" id="assign-this" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('assignCore')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <h2>ODC In</h2>
                <input type="hidden" name="core_splited_id" id="core_splited_id" value="">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_in" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Core</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="core_odc_in" value="" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Spliter</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="spliter" value="" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h2>ODC Out</h2>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_out" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Port</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="port_odc_out" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Distribution</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="dist_odc_out" value="" class="form-control" required>
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


{{-- EDIT --}}
<div class="modal fade" id="edit-assign-this" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <div class="text-right">
              <a href="#" id="btn-assign-odp" class="btn btn-primary assign-odp" data-toggle="modal" data-target="#assign-odp">Assign to ODP</a>
          </div>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="#" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <h2>ODC In</h2>
                <input type="hidden" name="core_splited_id" id="edit_core_splited_id" value="">
                <input type="hidden" name="core_id" id="edit_core_id" value="">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_in" id="edit_panel_odc_in" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Core</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="core_odc_in" id="edit_core_odc_in" value="" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Spliter</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="spliter" id="edit_spliter" value="" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h2>ODC Out</h2>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_out" id="edit_panel_odc_out" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Port</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="port_odc_out" id="edit_port_odc_out" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Distribution</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="dist_odc_out" id="edit_dist_odc_out" value="" class="form-control" required>
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






{{-- ASSIGN TO ODP --}}
<div class="modal fade" id="assign-odp" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('assignOdp')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <h2>Assign to ODP</h2>
                <input type="hidden" name="core_splited_id" id="to_odp_core_splited_id" value="">
                <input type="hidden" name="core_id" id="to_odp_core_id" value="">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Frame ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_frame_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Longitude</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="long" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Latitude</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="lat" value="" class="form-control" required>
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

{{-- EDIT WITH ODP --}}
<div class="modal fade" id="edit-assign-this-with-odp" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
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
                <h2>ODC In</h2>
                <input type="hidden" name="core_splited_id" id="edit_core_splited_id_with_odp" value="">
                <input type="hidden" name="core_id" id="edit_core_id_with_odp" value="">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_in" id="edit_panel_odc_in_with_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Core</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="core_odc_in" id="edit_core_odc_in_with_odp" value="" class="form-control" required>
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Spliter</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="spliter" id="edit_spliter_with_odp" value="" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h2>ODC Out</h2>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Panel</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="panel_odc_out" id="edit_panel_odc_out_with_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Port</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="port_odc_out" id="edit_port_odc_out_with_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Distribution</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="dist_odc_out" id="edit_dist_odc_out_with_odp" value="" class="form-control" required>
                    </div>
                </div>

                <hr>
                <h2>ODP</h2>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>No. ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" name="odp_id" id="edit_odp_id">
                        <input type="number" name="no_odp" id="edit_no_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama Frame ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_frame_odp" id="edit_nama_frame_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_odp" id="edit_nama_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Long ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="long_odp" id="edit_long_odp" value="" class="form-control" required>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Lat ODP</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="lat_odp" id="edit_lat_odp" value="" class="form-control" required>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div> --}}
        </form>
      </div>
    </div>
</div>


<script>
    $(".assign-this").click(function (e) {
        e.preventDefault();
        const core_splited_id = $(this).data('core_splited_id')
        // alert(core_splited_id);
        $("#core_splited_id").val(core_splited_id);
    });

    $(".edit-assign-this").click(function (e) {
        e.preventDefault();
        const edit_core_splited_id = $(this).data('core_splited_id')
        const edit_panel_odc_in = $(this).data('panel_odc_in')
        const edit_core_odc_in = $(this).data('core_odc_in')
        const edit_spliter = $(this).data('spliter')


        const edit_panel_odc_out = $(this).data('panel_odc_out')
        const edit_port_odc_out = $(this).data('port_odc_out')
        const edit_dist_odc_out = $(this).data('dist_odc_out')

        const edit_core_id = $(this).data('core_id')


        $("#edit_core_splited_id").val(edit_core_splited_id);
        $("#edit_core_id").val(edit_core_id);
        $("#edit_panel_odc_in").val(edit_panel_odc_in)
        $("#edit_core_odc_in").val(edit_core_odc_in)
        $("#edit_spliter").val(edit_spliter)
        $("#edit_port_odc_out").val(edit_port_odc_out)
        $("#edit_panel_odc_out").val(edit_panel_odc_out)
        $("#edit_dist_odc_out").val(edit_dist_odc_out)

        $("#btn-assign-odp").attr("data-core_splited_id", edit_core_splited_id);
        $("#btn-assign-odp").attr("data-core_id", edit_core_id);
    });

    $(".assign-odp").click(function (e) {
        $("#edit-assign-this").modal("hide");
        const core_splited_id = $(this).data('core_splited_id');
        const core_id = $(this).data('core_id');

        $("#to_odp_core_splited_id").val(core_splited_id);
        $("#to_odp_core_id").val(core_id);
    });

    $(".edit-assign-this-with-odp").click(function (e) {
        e.preventDefault();
        const edit_core_splited_id = $(this).data('core_splited_id')
        const edit_panel_odc_in = $(this).data('panel_odc_in')
        const edit_core_odc_in = $(this).data('core_odc_in')
        const edit_spliter = $(this).data('spliter')


        const edit_panel_odc_out = $(this).data('panel_odc_out')
        const edit_port_odc_out = $(this).data('port_odc_out')
        const edit_dist_odc_out = $(this).data('dist_odc_out')

        const edit_core_id = $(this).data('core_id')

        const edit_odp_id = $(this).data('odp_id')
        const edit_no_odp = $(this).data('no_odp')
        const edit_nama_frame_odp = $(this).data('nama_frame_odp')
        const edit_nama_odp = $(this).data('nama_odp')
        const edit_long_odp = $(this).data('long_odp')
        const edit_lat_odp = $(this).data('lat_odp')


        $("#edit_core_splited_id_with_odp").val(edit_core_splited_id);
        $("#edit_core_id_with_odp").val(edit_core_id);
        $("#edit_panel_odc_in_with_odp").val(edit_panel_odc_in)
        $("#edit_core_odc_in_with_odp").val(edit_core_odc_in)
        $("#edit_spliter_with_odp").val(edit_spliter)
        $("#edit_port_odc_out_with_odp").val(edit_port_odc_out)
        $("#edit_panel_odc_out_with_odp").val(edit_panel_odc_out)
        $("#edit_dist_odc_out_with_odp").val(edit_dist_odc_out)




        $("#edit_odp_id").val(edit_odp_id)
        $("#edit_no_odp").val(edit_no_odp)
        $("#edit_nama_frame_odp").val(edit_nama_frame_odp)
        $("#edit_nama_odp").val(edit_nama_odp)
        $("#edit_long_odp").val(edit_long_odp)
        $("#edit_lat_odp").val(edit_lat_odp)



    });

    $("select[name='odc_id']").change(function(e){
    var odc_id = $(this).val();
    var url = "/dashboard/feeder/{{$id}}/"+"odc/"+odc_id;
    window.location.href = url;
  })
</script>

@endsection


