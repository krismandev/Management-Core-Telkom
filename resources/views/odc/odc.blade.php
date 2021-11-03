@extends('layouts2.master')
@section('title','ODC')
@section('header')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.20/datatables.min.css"/>
@stop
@section('breadcrumb')
    <li><span>ODC</span></li>
@endsection
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah ODC Seluruh STO</div>
                        <h2>{{jumlah_odc()}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
        @if (isset($sto_selected))
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg2"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah ODC pada STO {{$sto_selected->nama_sto}}</div>
                        <h2>{{$jumlah_odc_filtered}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-lg-12 mt-5">
        <div class="card">
            <div class="card-body">

                <h4 class="header-title">Data ODC @if(isset($sto_selected)) - STO {{$sto_selected->nama_sto}} @endif</h4>

                <div class="text-right">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahodc">Tambah</button>
                    <div class="pull-right">
                        <select name="sto_id" id="" class="form-control">
                            @if(isset($sto_selected))
                                <option value="{{$sto_selected->id}}" selected>{{$sto_selected->nama_sto}}</option>
                            @else
                                <option value="" selected>Pilih STO</option>
                            @endif
                            @foreach ($stos as $sto)
                            <option value="{{$sto->id}}">{{$sto->nama_sto}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="single-table mt-3">
                    <div class="table-responsive">
                        <table class="table" id="data_odcs_reguler">
                            <thead class="text-uppercase bg-dark">
                                <tr class="text-white text-center">
                                    <th scope="col">#</th>
                                    <th scope="col"> Nama ODC</th>
                                    <th scope="col"> Feeder</th>
                                    <th scope="col">Start Core</th>
                                    <th scope="col">End Core</th>
                                    <th scope="col">Long</th>
                                    <th scope="col">Lat</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // dd($odcs);
                                @endphp
                                @foreach ($odcs as $odc)
                                <tr class="text-center">
                                    <th scope="row">{{$loop->iteration}}</th>
                                    <td>{{$odc->nama_odc}}</td>
                                    <td>{{$odc->nama_feeder}}</td>
                                    <td>{{$odc->start_core}}</td>
                                    <td>{{$odc->end_core}}</td>
                                    <td>{{$odc->long}}</td>
                                    <td>{{$odc->lat}}</td>
                                    <td>
                                        <a href="#" class="btn btn-warning edit-odc" data-toggle="modal" data-target="#editodc" data-odc_id="{{$odc->id}}" data-nama_odc="{{$odc->nama_odc}}" data-alamat="{{$odc->alamat}}" data-long="{{$odc->long}}" data-lat="{{$odc->lat}}">Edit</a>
                                        {{-- <a href="#" class="btn btn-danger hapus-odc" data-odc_id="{{$odc->id}}">Hapus</a> --}}
                                        <a href="{{route('showOdc',$odc->id)}}" class="btn btn-primary">Buka</a>
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
<div class="modal fade" id="tambahodc" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('storeOdc')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama ODC</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="nama_odc" value="{{old('nama_odc')}}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Start Core</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="start_core" value="{{old('start_core')}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>End Core</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="end_core" value="{{old('end_core')}}" class="form-control">
                    </div>
                </div>

                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Feeder</span>
                    </div>
                    <div class="col-md-12">
                        <select name="feeder_id" id="" class="form-control" required>
                            <option value="">Pilih Feeder</option>
                            @foreach ($feeders as $feeder)
                                <option value="{{$feeder->id}}">{{$feeder->nama_feeder}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Kapasitas</span>
                    </div>
                    <div class="col-md-12">
                        <input type="number" name="kapasitas"  value="{{old('kapasitas')}}" class="form-control">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Long</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="long" value="{{old('long')}}" class="form-control" onkeypress="return isNumberKey(event)">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Lat</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="lat" value="{{old('lat')}}" class="form-control" onkeypress="return isNumberKey(event)">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Alamat</span>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" rows="4" name="alamat">{{old('alamat')}}</textarea>
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

<div class="modal fade" id="editodc" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form class="" action="{{route('updateOdc')}}" method="post" enctype="multipart/form-data">
            @csrf @method('PATCH')
            <div class="modal-body">
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Nama odc</span>
                    </div>
                    <div class="col-md-12">
                        <input type="hidden" id="edit_odc_id" name="odc_id">
                        <input type="text" name="nama_odc" id="edit_nama_odc" value="" class="form-control" placeholder="Masukkan nama odc Edit">
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
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Long</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="long" id="edit_long" value="" class="form-control" onkeypress="return isNumberKey(event)">
                    </div>
                </div>
                <div class="row form-group">
                    <div class="col-md-12">
                        <span>Lat</span>
                    </div>
                    <div class="col-md-12">
                        <input type="text" name="lat" id="edit_lat" value="" class="form-control" onkeypress="return isNumberKey(event)">
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
        $('#data_odcs_reguler').DataTable();
        $(".edit-odc").click(function (e) {
            e.preventDefault();
            const odc_id = $(this).data('odc_id')
            const nama_odc = $(this).data('nama_odc')
            const alamat = $(this).data('alamat')
            const long = $(this).data('long')
            const lat = $(this).data('lat')

            // alert(long)

            $("#edit_odc_id").val(odc_id);
            $("#edit_nama_odc").val(nama_odc);
            $("#edit_alamat").html(alamat);
            $("#edit_long").val(long);
            $("#edit_lat").val(lat);
        });

        function setInputFilter(textbox, inputFilter) {
            ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
                textbox.addEventListener(event, function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
                } else {
                    this.value = "";
                }
                });
            });
        }

        setInputFilter(document.getElementById("long_odc"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        });
        setInputFilter(document.getElementById("lat_odc"), function(value) {
            return /^\d*\.?\d*$/.test(value); // Allow digits and '.' only, using a RegExp
        });

    });

    $('.hapus-odc').click(function(){
			const odc_id = $(this).data('odc_id');

            swal({
                title: "Yakin?",
                text: "Ingin menghapus data ini?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    window.location = "/dashboard/odc/delete/"+odc_id;
                }
            });


		});

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

        $("select[name='sto_id']").change(function(e){
            var sto_id = $(this).val();
            var url = "/dashboard/odc/"+sto_id;
            window.location.href = url;
        })
</script>
@endsection
