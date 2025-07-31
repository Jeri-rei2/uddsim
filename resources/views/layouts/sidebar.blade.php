        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
                    <!-- <span class="app-brand-logo demo">
                
              </span> -->
                    <span class="app-brand-text demo menu-text fw-bolder ms-2">
                        <img src="{{asset('sneat/assets/img/logok.png')}}" style=" width: 79px; height: 62px;"> </span>
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>



            @if(auth()->user()->type === "admin")

            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                <li class="menu-item {{ request()->is('admin/home') ? 'active' : ''}}">
                    <a href="{{route('admin.home')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Beranda</div>
                    </a>
                </li>

                <!-- Menu Utama -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Menu Utama</span>
                </li>
                <!-- Layouts -->

                <li class="menu-item {{ request()->is('admin/barang*') ? 'active open' : ''}} {{ request()->is('admin/kategori*') ? 'active open' : ''}} {{ request()->is('admin/stock*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-box"></i>
                        <div data-i18n="master">Master </div>
                    </a>

                    <ul class="menu-sub ">
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="barang">Barang</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="{{route('cabang.index')}}" class="menu-link">
                              <div data-i18n="cabang"> Cabang </div> 
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="{{route('supplier.index')}}"class="menu-link" > 
                               <div data-i18n="supplier"> Supplier </div> 
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link"> 
                               <div data-i18n="diagnosa">Diagnosa </div> 
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                 <div data-i18n="service cost">Service Cost </div> 
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="bank darah">Bank Darah </div> 
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                             <div data-i18n="petugas">Petugas</div> 
                            </a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Jenis Biaya</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="{{route('pekerjaan.index')}}" class="menu-link">
                            <div data-i18n="pekerjaan"> Pekerjaan Donor </div>
                            </a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="{{route('wilayah.index')}}" class="menu-link">
                            <div data-i18n="pekerjaan"> Wilayah Domisili Donor </div> 
                            </a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Jabatan</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Bagian (Divisi PMI)</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Mobile Unit</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Kelompok Biaya</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">WNI Donor</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="{{route('darah.index')}}" class="menu-link">Asal Darah</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Tujuan Darah</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Metode Serologi</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Reagen Serologi</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Pasien Poli Sintemi</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Bagian (RS)</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Tujuan Darah (RS)</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Jenis Darah</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Jenis Tujuan</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Kelas Tujuan</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Kecamatan</a></li>
                        <li class="menu-item {{ request()->is('admin/barang*') ? 'active' : ''}}">
                            <a href="" class="menu-link">Biaya Cros Test</a>
                        </li>
                       
                    </ul>
                </li>

                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-mail-send"></i>
                        <div data-i18n="transaksi">Transaksi</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('mdonor.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Master Pendaftaran Donor (Baru)</div>
                            </a>
                        </li>
                        
                        <li class="menu-item {{ request()->is('admin/pembayaran*') ? 'active' : ''}}">
                            <a href="#" class="menu-link">
                                <div data-i18n="pembayaran">Pendaftaran Polysitemy </div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/riwayat-pesanan') ? 'active' : ''}}">
                            <a href="#" class="menu-link">
                                <div data-i18n="history">Penyesuaian Data Donor</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"> <i class='bx bxs-donate-blood' > </i> Seleksi Donor</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('perisadokter.index')}}" class="menu-link">
                                <div data-i18n="pkesdor">Pemeriksaan Kesehatan Donor</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pembayaran*') ? 'active' : ''}}">
                            <a href="{{route('periksahb.index')}}" class="menu-link">
                                <div data-i18n="hb">Pemeriksaan (HB & Gol Darah) </div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/riwayat-pesanan') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="history">Pemeriksaan Pra Donasi Pheresis</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx bx-plus-medical'> </i> AFtap UTD </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('transaksidonor.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Transaksi Donor</div>
                            </a>
                        </li>
                          <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('ffp.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Pengiriman Darah dan Sampel(FFP)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('permintaan.kantong')}}" class="menu-link">
                                <div data-i18n="mdonor"> Permintaan Kantong Darah</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('penerimaan')}}" class="menu-link">
                                <div data-i18n="mdonor"> Penerimaan Kantong (dr Gudang)</div>
                            </a>
                        </li>
                          <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('penyisihan')}}" class="menu-link">
                                <div data-i18n="mdonor"> Penyisihan Kantong Rusak</div>
                            </a>
                        </li>
                          <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor"> Pemeriksaan data Kantong</div>
                            </a>
                        </li>
                          <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('mu')}}" class="menu-link">
                                <div data-i18n="mdonor"> Pengeluaran Kantong (Ke MU)</div>
                            </a>
                        </li>
                          <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('balikmu')}}" class="menu-link">
                                <div data-i18n="mdonor"> Pengembalian Kantong darah (Dari MU)</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx bxs-building-house'> </i> Gudang </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('Gudang.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Pendataan Kantong Darah (Barcode)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('pengeluaran.gudang')}}" class="menu-link">
                                <div data-i18n="mdonor"> Pengeluaran Kantong Darah (Ke Aftap )</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('stok.gudang')}}" class="menu-link">
                                <div data-i18n="mdonor"> Penerimaan Kantong darah (Stok Kantong)</div>
                            </a>
                        </li>
                    </ul>
                </li>
                    <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx  bx-test-tube'  ></i> Pemeriksaan Serologi </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('sero.index')}}" class="menu-link">
                                <div data-i18n="mdonor"> Serologi Umum</div>
                            </a>
                        </li>
                         <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor"> Serologi Sifilis</div>
                            </a>
                        </li>
                            <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor"> Serologi Lain</div>
                            </a>
                        </li>
                    </ul>
                </li>
                  <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx  bx-box'  ></i> LITBANG </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('goldarulang.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Pemeriksaan ulang GolDar</div>
                            </a>
                        </li>   
                    </ul>
                     <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor">Informasi Screening & Goldar</div>
                            </a>
                        </li>   
                    </ul>
                     <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor">Screening</div>
                            </a>
                        </li>   
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx  bx-box'  ></i> Produksi </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor">Produksi Darah</div>
                            </a>
                        </li>
                       
                    </ul>
                </li>



                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                   
                        <div data-i18n="transaksi"> <i class='bx bxs-add-to-queue' > </i> Antrian </div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('antrian.mandiri')}}" class="menu-link">
                                <div data-i18n="mdonor">Antrian Mandiri Pedonor</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('antrian.mandiri')}}" class="menu-link">
                                <div data-i18n="mdonor"> Antrian Online</div>
                            </a>
                        </li>
                      
                    </ul>
                </li>

                <!-- Menu Lainnya -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Menu Lainnya</span>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                   
                        <div data-i18n="transaksi"> <i class='bx bxs-add-to-queue' > </i> Laporan </div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('laporan.aftap')}}" class="menu-link">
                                <div data-i18n="mdonor">Laporan Stok Kantong Aftap</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor"> </div>
                            </a>
                        </li>
                      
                    </ul>
                </li>


                <li class="menu-item">
                    <a href="{{route('kirim.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Pengiriman External</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{route('permintaan.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Permintaan External</div>
                    </a>
                </li>
             <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Bridging Mesin </span>
                </li>
                <li class="menu-item">
                    <a href="{{route('mesin.index')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Alinity / Sysmex </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">TF</div>
                    </a>
                </li>
                <!-- Menu Lainnya -->
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Bridging </span>
                </li>


                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Kirim Permintaan </div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Analytics">Kirim Pedonor</div>
                    </a>
                </li>
                <!-- END Menu Lainnya -->
            </ul>

            @elseif(auth()->user()->type === "pimpinan")
            <ul class="menu-inner py-1">
                <li class="menu-item {{ request()->is('pimpinan/home') ? 'active' : ''}}">
                    <a href="{{route('pimpinan.home')}}" class="menu-link">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Analytics">Beranda</div>
                    </a>
                </li>
                <li class="menu-header small text-uppercase">
                    <span class="menu-header-text">Menu Utama</span>
                </li>
                <li class="menu-item {{ request()->is('pimpinan/laporan*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-report"></i>
                        <div data-i18n="laporan">Laporan</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('pimpinan/laporan/stock') ? 'active' : ''}}">
                            <a href="{{route('pimpinan.pesanan.laporan_stock')}}" class="menu-link">
                                <div data-i18n="laporan penjualan">Laporan Stock</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('pimpinan/laporan/transaksi') ? 'active' : ''}}">
                            <a href="{{route('pimpinan.pesanan.laporan_transaksi')}}" class="menu-link">
                                <div data-i18n="laporan stock">Laporan Transaksi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('pimpinan/laporan/jurnal-umum') ? 'active' : ''}}">
                            <a href="{{route('pimpinan.pesanan.jurnal-umum')}}" class="menu-link">
                                <div data-i18n="Jurnal Umum">Jurnal Umum</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('pimpinan/laporan/laba-rugi') ? 'active' : ''}}">
                            <a href="{{route('pimpinan.pesanan.laba-rugi')}}" class="menu-link">
                                <div data-i18n="Laba Rugi">Laba Rugi</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('pimpinan/laporan/buku-besar') ? 'active' : ''}}">
                            <a href="{{route('pimpinan.pesanan.buku-besar')}}" class="menu-link">
                                <div data-i18n="Buku Besar">Buku Besar</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

            @elseif(auth()->user()->department_id === "2")
            <ul class="menu-inner py-1">
                <!-- Dashboard -->
                    <li class="menu-item {{ request()->is('user/home') ? 'active' : ''}}">
                        <a href="{{route('home')}}" class="menu-link">
                            <i class="menu-icon tf-icons bx bx-home-circle"></i>
                            <div data-i18n="Analytics">Beranda</div>
                        </a>
                    </li>

                    <!-- Menu Utama -->
                    <li class="menu-header small text-uppercase">
                        <span class="menu-header-text">Menu Utama</span>
                    </li>
                    <li class="menu-item {{ request()->is('user/pesanan*') ? 'active open' : ''}} {{ request()->is('user/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <div data-i18n="transaksi"><i class='bx bxs-building-house'> </i> Gudang </div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item {{ request()->is('user/pesanan*') ? 'active' : ''}}">
                                <a href="{{route('user.br')}}" class="menu-link">
                                    <div data-i18n="mdonor">Pendataan Kantong Darah (Barcode)</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('user/gudang*') ? 'active' : ''}}">
                                <a href="{{route('user.gudang')}}" class="menu-link">
                                    <div data-i18n="mdonor"> Pengeluaran Kantong Darah (Ke Aftap )</div>
                                </a>
                            </li>
                            <li class="menu-item {{ request()->is('user/pesanan*') ? 'active' : ''}}">
                                <a href="{{route('user.stok.gudang')}}" class="menu-link">
                                    <div data-i18n="mdonor"> Penerimaan Kantong darah (Stok Kantong)</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
                 @elseif(auth()->user()->department_id === "3")
              <ul class="menu-inner py-1">
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"> <i class='bx bxs-donate-blood' > </i> Seleksi Donor</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('user.periksahb.index')}}" class="menu-link">
                                <div data-i18n="pkesdor">Pemeriksaan Kesehatan Donor</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pembayaran*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="hb">Pemeriksaan (HB & Gol Darah) </div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/riwayat-pesanan') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="history">Pemeriksaan Pra Donasi Pheresis</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active open' : ''}} {{ request()->is('admin/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('admin/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <div data-i18n="transaksi"><i class='bx bx-plus-medical'> </i> AFtap UTD </div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('user.transaksidonor.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Transaksi Donor</div>
                            </a>
                        </li>
                         <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('mdonor.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Pengiriman Darah dan Sampel(FFP)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('user.permintaan.kantong')}}" class="menu-link">
                                <div data-i18n="mdonor"> Permintaan Kantong Darah</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('admin/pesanan*') ? 'active' : ''}}">
                            <a href="" class="menu-link">
                                <div data-i18n="mdonor"> Penerimaan Kantong (dr Gudang)</div>
                            </a>
                        </li>
                    </ul>
                </li>
    </ul>
      @elseif(auth()->user()->department_id === "5")
       <ul class="menu-inner py-1">
          <li class="menu-item {{ request()->is('user/pesanan*') ? 'active open' : ''}} {{ request()->is('user/riwayat-pesanan*') ? 'active open' : ''}} {{ request()->is('user/pembayaran*') ? 'active open' : ''}}">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-mail-send"></i>
                        <div data-i18n="transaksi">Transaksi</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item {{ request()->is('user/pesanan*') ? 'active' : ''}}">
                            <a href="{{route('user.mdonor.index')}}" class="menu-link">
                                <div data-i18n="mdonor">Master Pendaftaran Donor (Baru)</div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('user/pembayaran*') ? 'active' : ''}}">
                            <a href="#" class="menu-link">
                                <div data-i18n="pembayaran">Pendaftaran Polysitemy </div>
                            </a>
                        </li>
                        <li class="menu-item {{ request()->is('user/riwayat-pesanan') ? 'active' : ''}}">
                            <a href="#" class="menu-link">
                                <div data-i18n="history">Penyesuaian Data Donor</div>
                            </a>
                        </li>
                    </ul>
                </li>

        </ul>




            @endif


        </aside>
        <!-- / Menu -->
