 <!-- sidebar menu area start -->
    <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                         @guest
                         @if (Route::has('login'))
                        @endif
                        @if (Route::has('register'))
                        @endif
                        @else
                        <div class="avatar avatar-online">
                            <img src="{{asset('profile-picture')}}/{{auth()->user()->picture}}" alt class="w-px-40 rounded-circle" />
                            {{ Auth::user()->name }}
                        </div>
                        @endguest
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                         @if(auth()->user()->type === "admin")
                            <nav>
                                <ul class="metismenu {{ request()->is('admin/home') ? 'active' : ''}}" id="menu" >
                                    <li class="active">
                                        <a href="{{route('admin.home')}}">
                                            <i class="menu-icon tf-icons bx bx-home-circle"> Beranda </i>
                                        
                                        </a>
                                    
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i>
                                        <span>Transaksi
                                            </span></a>
                                        <ul class="collapse">
                                            <li><a href="">Master Donor (Baru)</a></li>
                                            <li><a href="">Pendaftaran Donor UTD</a></li>
                                            <li><a href=""></a></li>

                                        </ul>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-palette"></i>
                                        <span>Master Data</span></a>
                                        <ul class="collapse">
                                            <li><a href="{{route('barang.index')}}">Barang</a></li>
                                  
                                        </ul>
                                    </li>
                                
                                </ul>
                                @elseif(auth()->user()->type === "pimpinan")
                                <ul class="metismenu {{ request()->is('admin/home') ? 'active' : ''}}" id="menu" >
                                    <li class="active">
                                    <a href="{{route('admin.home')}}" class="menu-link">
                                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                                            <div data-i18n="Analytics">Beranda</div>
                                        </a>
                                        <ul class="collapse">
                                            <li class="active"><a href="{{route('home')}}">Beranda</a></li>
                                        
                                        </ul>
                                    </li>
                                </ul>
                                @elseif(auth()->user()->type === "user")
                                <ul class="metismenu {{ request()->is('admin/home') ? 'active' : ''}}" id="menu" >
                                     <li>
                                         <a href="javascript:void(0)" aria-expanded="true">
                                            <span>Dashboard</span></a>
                                              <ul class="collapse">
                                               <li class="active"><a href="{{route('home')}}"> <i class="menu-icon tf-icons bx bx-home-circle"></i> Beranda</a></li>
                                              </ul>
                                     </li>
                                     <li>
                                        <a href="javascript:void(0)" aria-expanded="true"><i class="ti-layout-sidebar-left"></i>
                                        <span>Gudang
                                            </span></a>
                                        <ul class="collapse">
                                            <li><a href="">Pendataan Kantong Darah (Barcode)</a></li>
                                            <li><a href="">Pengeluaran Kantong Darah (Ke Aftap)</a></li>
                                            <li><a href="">Penerimaan Kantong Darah (Stok)</a></li>

                                        </ul>
                                    </li>
                                </ul>
                                
                            </nav>
                         @endif
                </div>
            </div>
    </div>

        <!-- sidebar menu area end -->