

@extends('layouts2.master')
@section('title','Dashboard')
@section('content')
<div class="col-lg-12">
    <div class="row">
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg1"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah STO</div>
                        <h2>{{jumlah_sto()}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg2"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah Feeder</div>
                        <h2>{{jumlah_feeder()}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg5"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah ODC</div>
                        <h2>{{jumlah_odc()}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-5 mb-3">
            <div class="card">
                <div class="seo-fact sbg4"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <div class="p-4 d-flex justify-content-between align-items-center">
                        <div class="seofct-icon"><i class="ti-share"></i> Jumlah ODP Aktif</div>
                        <h2>{{jumlah_odp_aktif()}}</h2>
                    </div>
                    <canvas id="seolinechart1" height="52" width="316" style="display: block; width: 316px; height: 52px;" class="chartjs-render-monitor"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
