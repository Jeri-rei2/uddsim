@extends('backend.adm')
@section('title', 'User Home')


@section('content')
@push('custom-css')
<link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="{{asset('fe/css/styles.css')}}" rel="stylesheet" />
@endpush
@section('content')

<section class="py-2 mt-5">
        <div class="container px-4 px-lg-5 mt-0">
            <div class="site-section-heading text-center py-4">
                <h2 style="font-family: 'Fira Sans', sans-serif; font-weight:bold">Pilih Area anda </h2>
            </div>
            <div class="col-md-12">
                <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-lg-4 d-flex justify-content-center product">
                </div>
            </div>
        </div>
    </section>
<div class="listCard">

</div>

<br />
<br />

<br />

<br />


 <!-- Footer-->
 <footer class="py-5 bg-dark">
        <div class="container">
            <div class="total"></div>
            <p class="m-0 text-center text-white">
                Copyright &copy; IT RS.SMS
            </p>
        </div>
    </footer>

@endsection
    @push('custom-scripts')
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script>
        let product = document.querySelector('.product');
        let listCard = document.querySelector('.listCard');
        let total = document.querySelector('.total');
        let cart = document.querySelector('.cart');
        let products = @json($items);
        let listCards = [];

        let user_id = @json($user_id);
        console.log('user_id ', user_id)

        function initApp() {
            // debugger;
            if (localStorage.getItem('listaCards')) {
                listCards = JSON.parse(localStorage.getItem('listaCards'));
                reloadCard();
            }
            console.log(products)
            product.innerHTML = "";
            products.forEach((value, key) => {
                let newDiv = document.createElement('div');
                newDiv.classList.add('item');
                newDiv.innerHTML = `
                    <div class="col mb-5">
                        <div class="card h-100">
                            <!-- Product image-->
                             <!--<img class="card-img-top p-2 img-fluid" src="http://127.0.0.1:8000/product_image/${value.foto}" alt="..." /> -->
                            <!-- Product details-->
                            <div class="card-body px-4 py-1">
                                <div class="text-center">
                                    <!-- Product name-->
                                    <h5 class="fw-bolder" style="font-family: 'Roboto Condensed', sans-serif;">${value.nama}</h5>
                                    <div></div>
                                    <!-- Product price-->
                                </div>
                            </div>
                            <!-- Product actions-->
                            <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                                <div class="text-center mt-2">
                                    <div class="btn btn-danger text-white">Rp. ${value.harga.toLocaleString()}</div>
                                    <button onClick='addToCard(${key})' class="btn btn-outline-dark mt-auto" type="button"><i class='fa fa-paper-plane'></i></button>
                                </div>
                            </div>
                        </div>
                    </div>`;


                product.appendChild(newDiv);
            })

        }

        initApp();

        function addToCard(key) {
            // debugger;
            if(user_id == null) {
                window.location.href ="http://127.0.0.1:8000/login"
            } else {
                if (listCards[key] == null) {
                    // copy product form list to list card
                    listCards[key] = JSON.parse(JSON.stringify(products[key]));
                    listCards[key].quantity = 1;
                    listCards[key].price = listCards[key].harga;
                    listCards[key].user_id = user_id
                }
                reloadCard();

            }
        }

        function reloadCard() {
            listCard.innerHTML = '';
            let count = 0;
            let totalPrice = 0;
            let price = 0;
            console.log(listCards)
            listCards.forEach((value, key) => {
                totalPrice = totalPrice + parseInt(value.harga);
                count = count + value.quantity;
                price = value.harga
            })
            // cart.innerText = listCards.length;
            // console.log(count)
            let data = JSON.parse(localStorage.getItem('listaCards'))
            let cart = document.querySelector('.cart');
            console.log('total hraga', totalPrice.toLocaleString())
            data == null ? '0' : cart.innerText = data.length;

            localStorage.setItem('listaCards', JSON.stringify(listCards.filter(card => card !== null)));
        }

    </script>
@endpush


