@extends('backend.adm')
@section('title', 'cart')


@push('custom-css')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/5.0.7/sweetalert2.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="d-flex justify-content-between flex-column flex-sm-row">
    <h4 class="fw-bold py-2 mb-3"><span class="text-muted fw-light">Transaksi /</span> Pembayaran</h4>
  
</div>
    <!-- Section-->
    <section class="py-5">
        <div class="container px-4 px-lg-5 mt-0">
            <div class="container-fluid py-5">
                <div class="row">
                    <aside class="col-lg-9">
                        @if(session('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{session('message')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif
                        <div class="card mb-3">

                            <div class="table-responsive">
                                <form action="" method="POST">
                                    @csrf
                                    @method('POST')

                                    <table class="table table-bordered table-shopping-cart">
                                        <thead class="text-muted">
                                            <tr class="small text-uppercase">
                                                <th scope="col" width="20%" class="align-middle">Nomor Pesanan</th>
                                                <th scope="col"><input type="text" name="order_id" class="order_id form-control" id="order_id" readonly></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" width="20%" class="align-middle">Nama</th>
                                                <th scope="col"><input type="text" name="nama" class="nama form-control" id="nama" value="{{Auth::user()->name}}"></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Email</th>
                                                <th scope="col"><input type="text" name="email" class="email form-control" id="email" value="{{Auth::user()->email}}"></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Nomor Handphone</th>
                                                <th scope="col"><input type="text" name="phone_number" class="phone_number form-control" id="phone_number" value="{{Auth::user()->phone_number}}"></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">NIK (KTP)</th>
                                                <th scope="col"><input type="text" name="nik" class="nik form-control" id="nik" value="{{Auth::user()->nik}}"></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Alamat Lengkap</th>
                                                <th scope="col"><input type="text" name="alamat" class="alamat form-control" id="alamat" value="{{Auth::user()->alamat}}"></th>
                                            </tr>
                                            <tr class="small text-uppercase">
                                                <th scope="col" class="align-middle">Keluhan Anda</th>
                                                <th scope="col">
                                                <textarea name="keluhan" id="keluhan" class="keluhan form-control" cols="30" rows="7"></textarea></th>
                                            </tr>
                                        </thead>

                                    </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-bordered table-shopping-cart">
                                    <thead class="text-muted">
                                        <tr class="small text-uppercase">
                                            <th scope="col">Rincian Lokasi</th>
                                            <th scope="col" width="25%" class="text-center">Quantity</th>
                                            <th scope="col" width="30%" class="text-center">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody class="items">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </aside>
                    <aside class="col-lg-3">
                        <div class="card">
                            <input type="hidden" name="quantity[]" class="quantity">
                            <input type="hidden" name="total" class="input_total">
                            <input type="hidden" name="barang_id[]" class="barang_id">
                            <input type="hidden" name="harga[]" class="harga">
                            <input type="hidden" name="nik[]" class="nik">
                            <input type="hidden" name="alamat[]" class="alamat">
                            <!-- <input type="hidden" name="keluhan[]" class="keluhan"> -->

                              
                            <div class="card-body">
                              
                                <div class="mb-2">
                                    <label for="defaultFormControlInput" class="form-label">Pembayaran</label>
                                    <select name="type" id="type" class="form-control" required onchange="selectPayment()">
                                        <option value="" selected disabled>-- Pilih Pembayaran --</option>
                                        <!-- <option value="Cash">Cash</option> -->
                                        <option value="Transfer">Transfer</option>
                                    </select>
                                    @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="d-none mb-3" id="transfer">
                                    <label for="defaultFormControlInput" class="form-label">Nomor Rekening</label>
                                    <input type="text" readonly class="form-control @error('no_rek') is-invalid @enderror" name="no_rek" id="no_rek" value="BRI 08321312321" />
                                    @error('no_rek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </span>
                                    @enderror
                                </div>
                              
                                <dl class="dlist-align">
                                    <dt>Total price: </dt>
                                    <dd class="text-right px-1 total"> 0</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Discount:</dt>
                                    <dd class="text-right text-danger px-1"> -0</dd>
                                </dl>
                                <dl class="dlist-align">
                                    <dt>Total:</dt>
                                    <dd class="text-right text-dark b px-1">Rp. <strong class="grandtotal"> 0</strong></dd>
                                </dl>
                                <hr> <button type="submit" class="btn btn-out btn-primary btn-square btn-main" onclick="destroyLocalStorage()"> Selesaikan Pembayaran </button>
                                   <a href="/" class="btn btn-out btn-success btn-square btn-main mt-2" data-abc="true">Continue Shopping</a>
                                </form>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
        <!-- Footer-->
    </section>



    @endsection

@push('custom-scripts')
   <!-- Bootstrap core JS-->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        window.onload = function() {
            let randNumber = getRandomInt(1, 100000000000)
            document.getElementById('order_id').value = randNumber
            document.getElementById('keluhan');
            
        }

        function getRandomInt(min, max) {
            min = Math.ceil(min);
            max = Math.floor(max);
            return 'INV' + Math.floor(Math.random() * (max - min + 1)) + min;

        }

        function selectPayment() {
            let type = document.getElementById(`type`).value;
            let transfer = document.getElementById(`transfer`);
            if (type == "Transfer") {
                transfer.classList.remove("d-none")
            } else {
                transfer.classList.add("d-none")

            }
        }

        let data = JSON.parse(localStorage.getItem('listaCards'))
        let cart = document.querySelector('.cart');
        let total = document.querySelector('.total');
        let input_total = document.querySelector('.input_total');
        let quantity = document.querySelector('.quantity');
        let barang_id = document.querySelector('.barang_id');
        let harga = document.querySelector('.harga');
        let items = document.querySelector('.items');
        let nik = document.querySelector('.nik');
        let alamat = document.querySelector('.alamat');
        let keluhan = document.querySelector('.keluhan');


        let grandtotal = document.querySelector('.grandtotal');
        cart.innerText = data.length
        console.log(data)

        let user_id = @json($user_id);
        console.log('user_id ', user_id)

        function initApp() {

            items.innerHTML = "";
            let totalPrice = 0;
            let bid = [];
            let qty = [];
            let price = [];
            let kel = [];

            data.forEach((value, key) => {
                if (value.user_id == user_id) {
                    totalPrice = totalPrice + parseInt(value.harga);
                    // count = count + value.quantity;
                    let newDiv = document.createElement('tr');
                    newDiv.classList.add('item');
                    console.log(value.nama)
                    newDiv.innerHTML = `
                        <tr>
                        <td>
                            <figure class="itemside align-items-center">
                                <!---<div class="aside"><img src="http://127.0.0.1:8000/product_image/${value.foto}" class="img-sm" width="200"></div>-->
                                <figcaption class="info"> <a href="#" class="title text-dark" data-abc="true">${value.nama}</a>
                                  <!---  <p class="text-muted small">Tipe: ${value.tipe} <br> Ukuran: ${value.panjang} cm x ${value.lebar} cm</p>-->
                                </figcaption>
                            </figure>
                        </td>
                        <td class="d-flex justify-content-between">
                            <button onclick="changeQuantity(${key}, ${value.quantity - 1})" class="btn btn-sm btn-primary mx-1">-</button>
                            <div readonly type="number" class="count form-control text-center">${value.quantity}</div>
                            <button onclick="changeQuantity(${key}, ${value.quantity + 1})" class="btn btn-sm btn-primary mx-1">+</button>

                        </td>
                        <td>
                            <div class="price-wrap"> <var class="price">Rp. ${value.harga.toLocaleString()}</var> </div>
                        </td>
                        </tr>`

                    items.appendChild(newDiv);
                    bid.push(value.id)
                    kel.push(value.id)
                    qty.push(value.quantity)
                    price.push(value.harga)
                }

            })
            // console.log(totalPrice.toLocaleString())
            // quantity.innerText = count;
            console.log('total hraga', totalPrice)
            total.innerText = totalPrice.toLocaleString()
            grandtotal.innerText = totalPrice.toLocaleString()
            input_total.value = totalPrice.toLocaleString()
            barang_id.value = bid
            keluhan.value = kel
            harga.value = price
            quantity.value = qty
            localStorage.setItem('listaCards', JSON.stringify(data.filter(card => card !== null)));

        }

        initApp()


        function changeQuantity(key, quantity) {
            console.log('quantity ', quantity, key)
            if (quantity == 0) {
                delete data[key];
            } else {
                data[key].quantity = quantity;
                data[key].harga = (quantity * data[key].price);
            }
            initApp()
        }

        function destroyLocalStorage() {
            localStorage.clear();
        }

    </script>

@endpush