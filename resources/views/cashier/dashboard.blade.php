@extends('base')

@section('morecss')
    <link rel="stylesheet" href="{{ asset('/css/custom.style.css') }}">
    <style>
        .lazy-backdrop {
            position: fixed;
            display: none;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100vh;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.7) !important;
            z-index: 9999;
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="lazy-backdrop" id="overlay-loading">
        <div class="d-flex flex-column justify-content-center align-items-center">
            <div class="spinner-border text-light" role="status">
            </div>
            <p class="text-light">Sedang Menyimpan Data...</p>
        </div>
    </div>
    <div class="dashboard">
        {{--        <div class="d-flex justify-content-between align-items-center mb-1">--}}
        {{--            <div>--}}
        {{--                <p class="content-title">Menu Utama</p>--}}
        {{--                <p class="content-sub-title">Menu Utama Kasir</p>--}}
        {{--            </div>--}}
        {{--            <nav aria-label="breadcrumb">--}}
        {{--                <ol class="breadcrumb mb-0">--}}
        {{--                    <li class="breadcrumb-item active" aria-current="page">Menu Utama</li>--}}
        {{--                </ol>--}}
        {{--            </nav>--}}
        {{--        </div>--}}
        <div style="position: relative;" class=" w-100 ">
            <div class="row gx-3 p-3" style="margin: .005em; ">
                <div class="col-md-8">
                    <div class="bg-white p-3 rounded min-vh-100">
                        <div class="input-group mt-3">
                        <span class="input-group-text"><span class="material-symbols-outlined">
                                search
                            </span></span>
                            <input type="text" class="form-control" placeholder="Cari menu..." id="param">
                        </div>
                        <div id="panel-result">
                            <div class="d-flex flex-wrap">
                                <div class="card-menu">
                                    <img src="https://via.placeholder.com/150" class="card-img-top" alt="Nama Menu">

                                    <div class="content">
                                        <h5 class="namamenu">Nama Menu 1</h5>
                                        <p class="harga">Rp 10.000</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <div class="col-md-4 min-vh-100">
                    <div class=" bg-white p-3 rounded detail-menu mb-3">
                        <div id="panel-detail-result">
                            <div style="min-height: 200px;" class="d-flex align-items-center justify-content-center">
                                <div style="color: var(--dark); font-weight: 500;">Menu Belum Di Pilih...</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3 ">
                                <label for="qty" class="form-label">Jumlah</label>
                                <div class="d-flex">
                                    <input type="number" class="form-control me-2" id="qty" value="1"
                                           min="1">
                                    <a class="bt-primary" href="#" id="btn-add-cart">Masukan</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class=" bg-white p-3 rounded">
                        <!-- Tabel Keranjang -->
                        <table id="table-data" class="display table w-100">
                            <thead>
                            <tr>
                                <th scope="col">Menu</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Total</th>
                                <th scope="col">Aksi</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="text-total">
                            <p id="lbl-total">Total : Rp0</p>

                        </div>
                    </div>
                    <div class="bg-white p-3 rounded mt-3">
                        <div class="d-flex">
                            <div class="flex-1 w-100 me-2">
                                <label for="member" class="form-label fs-small">Pilih Member</label>
                                <select class="selectmember form-control" name="state" id="member">
                                    <option value="">Non Member</option>
                                    @foreach($members as $member)
                                        <option value="{{ $member->id }}">{{ $member->username }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="">
                                <label for="diskon" class="form-label fs-small">Diskon</label>
                                <input readonly value="0" class="form-control w-100" id="diskon"/>
                            </div>
                        </div>
{{--                        <div class="mb-1">--}}
{{--                            <label for="uangdibayar" class="form-label fs-small">Uang yang dibayarkan</label>--}}
{{--                            <input type="number" class="form-control" id="uangdibayar">--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="kembalian" class="form-label fs-small">Kembalian</label>--}}
{{--                            <input type="number" class="form-control" id="kembalian" readonly>--}}
{{--                        </div>--}}

                        <!-- Tombol Checkout -->
                        <a class="btn btn-primary w-100 mt-5" id="btn-pay" href="#">Bayar</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table, subTotal = 0, discount = 0, total = 0;
        var selectedMenu = null;

        async function getData() {
            try {
                let resultEl = $('#panel-result');
                resultEl.empty();
                resultEl.append(createLoader('sedang mengunduh data...', 400));
                let param = $('#param').val();
                let url = path + '?type=product&param=' + param;
                let response = await $.get(url);
                let data = response['data'];
                console.log(data);
                resultEl.empty();
                if (data.length > 0) {
                    resultEl.append(createProductElement(data));
                    eventSelectDetail();
                    // eventProductAction();
                } else {
                    resultEl.append(createEmptyProduct());
                }
            } catch (e) {
                alert('error' + e);
            }
        }

        async function getDataDetail(id) {
            try {
                let resultEl = $('#panel-detail-result');
                resultEl.empty();
                resultEl.append(createLoader('sedang mengunduh data...', 400));
                let url = path + '?type=detail&id=' + id;
                let response = await $.get(url);
                let data = response['data'];
                selectedMenu = data;
                console.log(data);
                resultEl.empty();
                if (data !== null) {
                    resultEl.append(createProductDetailElement(data));
                } else {
                    resultEl.append(createEmptySelectProduct());
                }
            } catch (e) {
                alert('error' + e);
            }
        }


        async function eventSearchHandler() {
            $("#param").keyup(
                debounce(function (e) {
                    console.log(e.currentTarget.value);
                    getData();
                }, 1000)
            );
        }

        function eventSelectDetail() {
            $('.btn-card').on('click', function () {
                let id = this.dataset.id;
                getDataDetail(id);
                console.log(id);
            })
        }

        function createProductElement(data = []) {
            let productsEl = '';
            $.each(data, function (k, v) {
                let id = v['id'];
                let image = v['image'];
                let name = v['name'];
                let price = v['price'];
                productsEl += '<div class="card-menu btn-card" data-id="' + id + '">' +
                    '<img src="' + image + '" class="card-img-top" alt="Nama Menu">' +
                    '<div class="content">' +
                    '<h5 class="namamenu">' + name + '</h5>' +
                    '<p class="harga">Rp ' + price.toLocaleString('id-ID') + '</p>' +
                    '</div>' +
                    '</div>';
            });
            return (
                '<div class="d-flex flex-wrap">' + productsEl +
                '</div>'
            )
        }

        function createProductDetailElement(data) {
            let image = data['image'];
            let name = data['name'];
            let price = data['price'];
            let content = data['description'].toString();
            let contentString = $.parseHTML(content);
            console.log(contentString);
            return '<img src="' + image + '" class="card-img-top" alt="Nama Menu">' +
                '<div class="card-body">' +
                '<p class="nama-menu">' + name + '</p>' +
                '<p class="harga-menu">Rp. ' + price.toLocaleString('id-ID') + '</p>' +
                '</div>';
        }

        function generateTable() {
            table = $('#table-data').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    'data': function (d) {
                        d.type = 'cart'
                    }
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                    // eventDelete();
                    eventDelete();
                    let data = this.fnGetData();
                    subTotal = data.map(item => item['total']).reduce((prev, next) => prev + next, 0);
                    clearDiscount();
                    calculateTotal();
                    // $('#lbl-total').html('Total Rp. ' + total.toLocaleString('id-ID'));
                },
                dom: 't',
                columns: [
                    {
                        data: 'menu.name',
                        className: 'middle-header',
                    },
                    {
                        data: 'qty',
                        className: 'middle-header',
                    },
                    {
                        data: 'price',
                        className: 'middle-header',
                    },
                    {
                        data: 'total',
                        className: 'middle-header',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlEdit = path + '/' + id + '/edit';
                            return '<td><a class="btn-danger-sm btn-delete-cart" data-id="' + id + '">x</a></td>';
                        }
                    }
                ],
            });
        }

        function clearDiscount() {
            $('#member').val('');
            discount = 0;
            $('#diskon').val(0);
        }

        function eventDelete() {
            $('.btn-delete-cart').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
                    CustomBaseDeleteHandler(path, {id}, function () {
                        table.ajax.reload();
                    });
                })
            })
        }

        function eventAddToCart() {
            $('#btn-add-cart').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin menambahkan pesanan?', function () {
                    addToCartHandler();
                })
            })
        }

        async function addToCartHandler() {
            try {
                blockLoading(true);
                let url = path + '/cart';
                await $.post(url, {
                    id: selectedMenu['id'],
                    qty: $('#qty').val()
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Menyimpan data...',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    table.ajax.reload();
                });
            } catch (e) {
                blockLoading(false);
                Swal.fire({
                    title: 'Ooops',
                    text: 'Gagal Menyimpan Data...',
                    icon: 'error',
                    timer: 700
                });
            }
        }

        async function getDiscount() {
            try {
                let url = path + '/cart/discount';
                let response = await $.get(url);
                let data = response['data'];
                discount = data;
                $('#diskon').val(discount);
                calculateTotal();
                console.log(data);
            } catch (e) {
                discount = 0;
                $('#diskon').val(0);
                calculateTotal();
                alert('error' + e);
            }
        }

        function eventChangeMember() {
            $('#member').on('change', function () {
                let val = this.value;
                if (val === '') {
                    discount = 0;
                    $('#diskon').val('0')
                    calculateTotal();
                } else {
                    getDiscount();
                }
            });
        }

        function calculateTotal() {
            let total = subTotal - discount;
            $('#lbl-total').html('Total Rp. ' + total.toLocaleString('id-ID'));
        }

        function eventCheckout() {
            $('#btn-pay').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin membuat pesanan?', function () {
                    checkoutHandler();
                })
            })
        }

        async function checkoutHandler() {
            try {
                blockLoading(true);
                let url = path + '/cart/checkout';
                await $.post(url, {
                    member: $('#member').val()
                });
                blockLoading(false);
                Swal.fire({
                    title: 'Berhasil',
                    text: 'Berhasil Membuat Pesanan...',
                    icon: 'success',
                    timer: 700
                }).then(() => {
                    table.ajax.reload();
                });
            } catch (e) {
                blockLoading(false);
                let error_message = JSON.parse(e.responseText);
                Swal.fire({
                    title: 'Ooops',
                    text: error_message,
                    icon: 'error',
                    timer: 700
                });
            }
        }

        $(document).ready(function () {
            eventSearchHandler();
            getData();
            generateTable();
            eventAddToCart();

            eventChangeMember();
            eventCheckout();
        });
    </script>
@endsection
