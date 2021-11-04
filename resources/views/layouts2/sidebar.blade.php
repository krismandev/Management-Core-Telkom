<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="index.html"><img src="{{asset('assets/images/telkom_putih.png')}}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="{{(request()->is('dashboard')) ? 'active' : ''}}"><a href="{{route('index')}}"><i class="ti-dashboard"></i> <span>Dashboard</span></a></li>
                    <li class="{{(request()->is('dashboard/sto*')) ? 'active' : ''}}"><a href="{{route('getSTO')}}"><i class="ti-map-alt"></i> <span>STO</span></a></li>
                    {{-- <li class="{{(request()->is('dashboard/sto/olt*')) ? 'active' : ''}}"><a href="{{route('getAllOlt')}}"><i class="ti-map-alt"></i> <span>OLT</span></a></li> --}}
                    {{-- <li class="{{(request()->is('dashboard/ftm*')) ? 'active' : ''}}"><a href="{{route('getFtmOa')}}"><i class="ti-map-alt"></i> <span>FTM</span></a></li> --}}
{{--                    <li class="{{(request()->is('dashboard/feeder*')) ? 'active' : ''}}"><a href="{{route('getFeeder')}}"><i class="ti-map-alt"></i> <span>Feeder</span></a></li>--}}
{{--                    <li class="{{(request()->is('dashboard/odc*')) ? 'active' : ''}}"><a href="{{route('getOdc')}}"><i class="ti-map-alt"></i> <span>ODC</span></a></li>--}}
                </ul>
            </nav>
        </div>
    </div>
</div>
