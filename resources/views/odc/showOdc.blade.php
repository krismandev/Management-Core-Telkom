@extends('layouts2.master')
@section('title','ODC')
@section('breadcrumb')
    <li> <a href="{{route('showSTO',$odc->feeder->sto->id)}}">{{$odc->feeder->sto->nama_sto}}</a> </li>
    <li><a href="{{route("showFeeder",$odc->feeder->id)}}">{{$odc->feeder->nama_feeder}}</a> </li>
    <li><span>{{$odc->nama_odc}}</span> </li>
@endsection
@section('content')
<div class="col-lg-12 mt-2">
    <div class="card">
        <div class="card-header">
            <h2>{{$odc->nama_odc}}</h2>
            <div class="row">
                Note: <br>
            </div>
            <div class="pull-left" style="margin-left: 20px;">
                <button class="btn btn-secondary" style="margin-right:5px;"></button>Belum ter-assign ke ODC
                <button class="btn btn-primary" style="margin-right:5px; margin-left: 15px;"></button>Sudah ter-assign ke ODC, namun belum ke ODP
                <button class="btn btn-success" style="margin-right:5px; margin-left: 15px;"></button>Ter-assign sampai ODP
                <button class="btn btn-danger" style="margin-right:5px; margin-left: 15px;"></button>ODP Rusak
            </div>
        </div>
        <div class="card-body">
            <h4 class="header-title">Core</h4>
            <div class="row mt-2">
                @foreach ($cores as $core)
                    <div class="col-lg-3 mt-3">
                        <span>{{$core->no_core_feeder}}</span>
                        @if($core->odc_id == null)
                            <button class="btn btn-secondary belum-tercatu" title="Belum tercatu ke ODC"></button>
                        @elseif($core->panel_odc_in == null)
                            <button class="btn btn-secondary assign-this" title="Assign Core Ini" data-toggle="modal" data-target="#assign-this" data-core_id="{{$core->id}}"></button>
                        @elseif($core->panel_odc_in != null && $core->core_splited != null)
                            @foreach ($core->core_splited as $core_splited)
                                @if ($core_splited->odp->status == "IDLE")
                                    <button class="btn btn-primary edit-assign-this" title="Assign Ke ODP" data-toggle="modal" data-target="#edit-assign-this"
                                            data-core_id="{{$core->id}}"
                                            data-core_splited_id="{{$core_splited->id}}"
                                            data-panel_odc_in="{{$core->panel_odc_in}}"
                                            data-core_odc_in="{{$core->core_odc_in}}"
                                            data-spliter="{{$core->spliter}}"></button>
                                @elseif($core_splited->status == 'assigned' || $core_splited->odp->status == 'assigned' || $core_splited->odp->status == 'RUSAK')

                                    <button class="btn {{($core_splited->odp->status == 'assigned') ? 'btn-success' : 'btn-danger'}} show-detail" data-toggle="modal" data-target="#show-core-odp"
                                            data-show_hostname="{{$core->olt->hostname}}"
                                            data-show_ip="{{$core->olt->ip}}"
                                            data-show_merk="{{$core->olt->merk}}"
                                            data-show_type="{{$core->olt->type}}"
                                            data-show_f="{{$core->olt->no_frame}}"
                                            data-show_s="{{$core->slot_olt->no_slot}}"
                                            data-show_p="{{$core->port_olt}}"
                                            data-show_rack="{{$core->feeder->ftm_oa->no_rak}}"
                                            data-show_panel_ftm="{{$core->panel}}"
                                            data-show_port_ftm="{{$core->no_core_feeder}}"
                                            data-show_no_feeder="{{$core->feeder->nama_feeder}}"
                                            data-show_kapasitas_feeder="{{$core->feeder->kapasitas}}"
                                            data-show_no_core_feeder="{{$core->no_core_feeder}}"
                                            data-show_nama_odc="{{$core->odc->nama_odc}}"
                                            data-show_long_odc="{{$core->odc->long}}"
                                            data-show_lat_odc="{{$core->odc->lat}}"
                                            data-show_panel_odc_in="{{$core->panel_odc_in}}"
                                            data-show_core_odc_in="{{$core->core_odc_in}}"
                                            data-show_spliter="{{$core->spliter}}"
                                            data-show_panel_odc_out="{{$core_splited->panel_odc_out}}"
                                            data-show_port_odc_out="{{$core_splited->port_odc_out}}"
                                            data-show_dist_odc_out="{{$core_splited->dist_odc_out}}"
                                            data-show_no_odp="{{$core_splited->odp->no_odp}}"
                                            data-show_nama_frame_odp="{{$core_splited->odp->nama_frame_odp}}"
                                            data-show_nama_odp="{{$core_splited->odp->nama_odp}}"
                                            data-show_long_odp="{{$core_splited->odp->long}}"
                                            data-show_lat_odp="{{$core_splited->odp->lat}}"
                                            data-show_odp_id="{{$core_splited->odp->id}}"
                                            data-show_odp_state="{{$core_splited->odp->status}}"></button>
                                @endif
                            @endforeach
                        @endif
                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

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

                    <h2>OLT</h2>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Pilih OLT</span>
                        </div>
                        <div class="col-md-12">
                            <select name="olt_id" id="" class="form-control" required>
                                <option value=""><small>Pilih OLT</small> </option>
                                @foreach ($feeder->sto->olt as $olt)
                                    <option value="{{$olt->id}}">{{$olt->hostname}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Slot OLT</span>
                        </div>
                        <div class="col-md-12">
                            <select name="slot_olt_id" id="slot_olt" class="form-control" required>
                                <option value="" selected><small>Pilih Slot</small> </option>
                            </select>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Port OLT</span>
                        </div>
                        <div class="col-md-12">
                            <input type="number" name="port_olt" value="" class="form-control" required>

                        </div>
                    </div>
                    <br>
                    <hr>

                    <h2>FTM</h2>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Panel FTM OA</span>
                        </div>
                        <div class="col-md-12">
                            <select name="panel" id="" class="form-control" required>
                                <option value=""><small>Pilih Panel</small> </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <hr>
                    <h2>ODC In</h2>
                    <input type="hidden" name="core_id" id="core_id" value="">
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Panel In</span>
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

                    {{-- <hr>
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
                    </div> --}}
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
                {{-- <div class="text-right">
                    <a href="#" id="btn-assign-odp" class="btn btn-primary assign-odp" data-toggle="modal" data-target="#assign-odp">Assign to ODP</a>
                </div> --}}
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
                            <span>Panel In</span>
                        </div>
                        <div class="col-md-12">
                            <input type="number" name="panel_odc_in" id="edit_panel_odc_in" value="" class="form-control" required>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-12">
                            <span>Core In</span>
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

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="#" class="btn btn-primary assign-odp" id="btn-assign-odp" data-toggle="modal" data-target="#assign-odp">Assign to ODP</a>
                </div>
            </form>
        </div>
    </div>
</div>






{{-- ASSIGN TO ODP --}}
<div class="modal fade bd-example-modal-lg" id="assign-odp">
    <div class="modal-dialog modal-lg">
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

                    <h2>ODC Out</h2>
                    <div class="row form-group">
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <span>Panel Out</span>
                            </div>
                            <div class="col-md-12">
                                <input type="number" name="panel_odc_out" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <span>Port</span>
                            </div>
                            <div class="col-md-12">
                                <input type="number" name="port_odc_out" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-md-12">
                                <span>Distribusi</span>
                            </div>
                            <div class="col-md-12">
                                <input type="number" name="dist_odc_out" value="" class="form-control" required>
                            </div>
                        </div>

                    </div>
                    <br>
                    <hr>
                    <h2>Assign to ODP</h2>
                    <input type="hidden" name="core_splited_id" id="to_odp_core_splited_id" value="">
                    <input type="hidden" name="core_id" id="to_odp_core_id" value="">
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="col-md-12">
                                <span>Nama Frame ODP</span>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="nama_frame_odp" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-12">
                                <span>Nama ODP</span>
                            </div>
                            <div class="col-md-12">
                                <input type="text" name="nama_odp" value="" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-6">
                            <div class="col-md-12">
                                <span>Longitude</span>
                            </div>
                            <div class="col-md-12">
                                <input type="text" onkeypress="return isNumberKey(event)" name="long" value="" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="col-md-12">
                                <span>Latitude</span>
                            </div>
                            <div class="col-md-12">
                                <input type="text" onkeypress="return isNumberKey(event)" name="lat" value="" class="form-control" required>
                            </div>
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



{{-- SHOW DETAIL CORE -> ODP --}}
<div class="modal fade bd-example-modal-lg modal-xl" id="show-core-odp">
    <div class="modal-dialog modal-lg modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
            </div>
            <div class="modal-body">
                <h2>OLT</h2>

                <div class="row form-group">
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Hostname</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_hostname" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>IP OLT</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_ip" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>Merk</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_merk" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>Type</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_type" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Frame</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_f" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Slot</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_s" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Port</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_p" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <h2>FTM OA</h2>
                <div class="row form-group">
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Rack</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_rack" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Panel</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_panel_ftm" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Port</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_port_ftm" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <h2>Feeder</h2>
                <div class="row form-group">
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Nomor Feeder</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_no_feeder" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Kapasitas</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_kapasitas_feeder" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>No Core Feeder</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_no_core_feeder" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <br>
                <h2>ODC In</h2>
                <div class="row form-group">
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Nama ODC</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_nama_odc" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Long ODC</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_long_odc" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Lat ODC</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_lat_odc" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Panel In</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_panel_odc_in" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Core In</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_core_odc_in" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-1">
                        <div class="col-md-12">
                            <span>Spliter</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_spliter" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>
                <h2>ODC Out</h2>
                <div class="row form-group">
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Panel Out</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_panel_odc_out" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Port</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_port_odc_out" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="col-md-12">
                            <span>Distribusi</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_dist_odc_out" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>

                <h2>ODP</h2>
                <div class="row form-group">
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>No. ODP</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_no_odp" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Nama Frame ODP</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_nama_frame_odp" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="col-md-12">
                            <span>Nama ODP</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_nama_odp" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>Long ODP</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_long_odp" value="" class="form-control" readonly>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="col-md-12">
                            <span>Lat ODP</span>
                        </div>
                        <div class="col-md-12">
                            <input type="text"  id="show_lat_odp" value="" class="form-control" readonly>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                {{-- <input type="button" value="" class="btn btn-danger btn-tandai-rusak" id="tandai_rusak"> --}}

                <button type="button" class="btn btn-danger btn-tandai-rusak" id="tandai_rusak">Tandai sebagai rusak</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
            </div>
        </div>
    </div>
</div>

@section('linkfooter')
    <script>

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : evt.keyCode
            switch (true) {
                case charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 45 && charCode != 46:
                    return false;
                    break;
                case charCode === 45:
                    return true;
                    break;
                case charCode === 46:
                    return true;
                default:
                    return true;
            }

        }

        $(document).ready(function () {
            $(".belum-tercatu").click(function (e) {
                alert("Belum tercatu ke ODC");
            })

            $(".assign-this").click(function (e) {
                e.preventDefault();
                const core_id = $(this).data('core_id')
                // alert(core_id);
                $("#core_id").val(core_id);
            });

            $(".edit-assign-this").click(function (e) {
                e.preventDefault();
                const edit_core_splited_id = $(this).data('core_splited_id')
                const edit_panel_odc_in = $(this).data('panel_odc_in')
                const edit_core_odc_in = $(this).data('core_odc_in')
                const edit_spliter = $(this).data('spliter')



                const edit_core_id = $(this).data('core_id')


                $("#edit_core_splited_id").val(edit_core_splited_id);
                $("#edit_core_id").val(edit_core_id);
                $("#edit_panel_odc_in").val(edit_panel_odc_in)
                $("#edit_core_odc_in").val(edit_core_odc_in)
                $("#edit_spliter").val(edit_spliter)

                $("#btn-assign-odp").removeAttr("data-core_splited_id");
                $("#btn-assign-odp").removeAttr("data-core_id");

                $("#btn-assign-odp").attr("data-core_splited_id", edit_core_splited_id);
                $("#btn-assign-odp").attr("data-core_id", edit_core_id);
                // alert(edit_core_splited_id);

                $("#btn-assign-odp").click(function (e) {

                    console.log(edit_core_splited_id);
                    console.log(edit_core_id);
                    $("#to_odp_core_splited_id").val(edit_core_splited_id);
                    $("#to_odp_core_id").val(edit_core_id);
                });
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

            $("select[name='olt_id']").change(function (e) {
                $("select[name='slo_olt_id']").empty();
                const olt_id = $(this).val(); //
                let url = '/dashboard/slot-olt/'+olt_id;
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        let hasil = '';
                        $.each(response.data, function (index, value) {
                            hasil += '<option value="'+value.id+'">';
                            hasil += 'Slot '+ value.no_slot;
                            hasil += '</option>';
                        });
                        $("select[name='slot_olt_id']").append(hasil);
                    }
                });

            });

            $(".show-detail").click(function (e) {
                const show_hostname = $(this).data("show_hostname")
                const show_ip = $(this).data("show_ip")
                const show_merk = $(this).data("show_merk")
                const show_type = $(this).data("show_type")
                const show_f = $(this).data("show_f")
                const show_s = $(this).data("show_s")
                const show_p = $(this).data("show_p")
                const show_rack = $(this).data("show_rack")
                const show_panel_ftm = $(this).data("show_panel_ftm")
                const show_port_ftm = $(this).data("show_port_ftm")
                const show_no_feeder = $(this).data("show_no_feeder")
                const show_kapasitas_feeder = $(this).data("show_kapasitas_feeder")
                const show_no_core_feeder = $(this).data("show_no_core_feeder")
                const show_nama_odc = $(this).data("show_nama_odc")
                const show_long_odc = $(this).data("show_long_odc")
                const show_lat_odc = $(this).data("show_lat_odc")
                const show_panel_odc_in = $(this).data("show_panel_odc_in")
                const show_core_odc_in = $(this).data("show_core_odc_in")
                const show_spliter = $(this).data("show_spliter")
                const show_panel_odc_out = $(this).data("show_panel_odc_out")
                const show_port_odc_out = $(this).data("show_port_odc_out")
                const show_dist_odc_out = $(this).data("show_dist_odc_out")
                const show_no_odp = $(this).data("show_no_odp")
                const show_nama_frame_odp = $(this).data("show_nama_frame_odp")
                const show_nama_odp = $(this).data("show_nama_odp")
                const show_long_odp = $(this).data("show_long_odp")
                const show_lat_odp = $(this).data("show_lat_odp")
                const show_odp_id = $(this).data("show_odp_id")
                const show_odp_state = $(this).data("show_odp_state")

                // console.log(show_odp_id);


                $("#show_hostname").val(show_hostname);
                $("#show_ip").val(show_ip);
                $("#show_merk").val(show_merk);
                $("#show_type").val(show_type);
                $("#show_f").val(show_f);
                $("#show_s").val(show_s);
                $("#show_p").val(show_p);
                $("#show_rack").val(show_rack);
                $("#show_panel_ftm").val(show_panel_ftm);
                $("#show_port_ftm").val(show_port_ftm);
                $("#show_no_feeder").val(show_no_feeder);
                $("#show_kapasitas_feeder").val(show_kapasitas_feeder);
                $("#show_no_core_feeder").val(show_no_core_feeder);
                $("#show_nama_odc").val(show_nama_odc);
                $("#show_long_odc").val(show_long_odc);
                $("#show_lat_odc").val(show_lat_odc);
                $("#show_panel_odc_in").val(show_panel_odc_in);
                $("#show_core_odc_in").val(show_core_odc_in);
                $("#show_spliter").val(show_spliter);
                $("#show_panel_odc_out").val(show_panel_odc_out);
                $("#show_port_odc_out").val(show_port_odc_out);
                $("#show_dist_odc_out").val(show_dist_odc_out);
                $("#show_no_odp").val(show_no_odp);
                $("#show_nama_frame_odp").val(show_nama_frame_odp);
                $("#show_nama_odp").val(show_nama_odp);
                $("#show_long_odp").val(show_long_odp);
                $("#show_lat_odp").val(show_lat_odp);

                if(show_odp_state === "RUSAK"){
                    $(".btn-tandai-rusak").hide();
                }else{
                    $(".btn-tandai-rusak").show();
                }

                $(".btn-tandai-rusak").click(function (e) {
                    swal({
                        title: "Yakin?",
                        text: "Menandai odp ini sebagai rusak!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true,
                    })
                        .then((willDelete) => {
                            if (willDelete) {
                                window.location = "/dashboard/mark-as-broke-odp/"+show_odp_id;
                            }
                        });
                });
            });

            $("select[name='odc_id']").change(function(e){
                var odc_id = $(this).val();
                var url = "/dashboard/feeder/{{$feeder->id}}/"+"odc/showcore/"+odc_id;
                window.location.href = url;
            })
        });
    </script>

@endsection
