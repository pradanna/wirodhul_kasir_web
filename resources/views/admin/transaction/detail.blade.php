@extends('base')

@section('morecss')
    <link rel="stylesheet" href="{{ asset('/css/custom.style.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Penjualan</p>
                <p class="content-sub-title">Manajemen data penjualan</p>
            </div>
            <nav aria-label="breadcrumb">
                @if(auth()->user()->role === 'cashier')
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('cashier.transaction') }}">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->no_reference }}</li>
                    </ol>
                @endif

                @if(auth()->user()->role === 'admin')
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.transaction') }}">Pesanan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $data->no_reference }}</li>
                    </ol>
                @endif
            </nav>
        </div>
        <div class="card-content">
            <div class="content-header mb-3">
                <p class="header-title" style="font-size: 0.8em">Data Penjualan</p>
            </div>
            <hr class="custom-divider"/>
            <div class="w-100">
                <div class="w-100 d-flex align-items-center mb-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <p style="margin-bottom: 0; font-weight: 500;" class="me-2">No. Pesanan :</p>
                    <p style="margin-bottom: 0">{{ $data->no_reference }}</p>
                </div>
                <div class="w-100 d-flex align-items-center mb-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <p style="margin-bottom: 0; font-weight: 500;" class="me-2">Tanggal Penjualan :</p>
                    <p style="margin-bottom: 0">{{ \Carbon\Carbon::parse($data->date)->format('d F Y') }}</p>
                </div>
                <div class="w-100 d-flex align-items-center mb-1"
                     style="font-size: 0.8em; font-weight: 600; color: var(--dark);">
                    <p style="margin-bottom: 0; font-weight: 500;" class="me-2">Member :</p>
                    @if($data->member !== null)
                        <p style="margin-bottom: 0">{{ $data->member->username }}</p>
                    @else
                        <p style="margin-bottom: 0">-</p>
                    @endif
                </div>
            </div>
            <hr class="custom-divider"/>
            <table id="table-data-cart" class="display table w-100">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="12%" class="text-center middle-header">Gambar</th>
                    <th>Nama Menu</th>
                    <th width="10%" class="text-end">Harga</th>
                    <th width="10%" class="text-center">Qty</th>
                    <th width="10%" class="text-end">Total</th>
                </tr>
                </thead>
            </table>
            <hr class="custom-divider"/>
            <div class="w-100 d-flex justify-content-end mb-1"
                 style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                <div class="me-2 w-100 text-end" style="width: 80%">Sub Total :</div>
                <div class="text-end" style="width: 20%">Rp.{{ number_format($data->sub_total, 0, ',', '.') }}</div>
            </div>
            <div class="w-100 d-flex justify-content-end mb-1"
                 style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                <div class="me-2 w-100 text-end" style="width: 80%">Diskon :</div>
                <div class="text-end" style="width: 20%">Rp.{{ number_format($data->discount, 0, ',', '.') }}</div>
            </div>
            <div class="w-100 d-flex justify-content-end"
                 style="font-size: 0.8em; font-weight: bold; color: var(--dark);">
                <div class="me-2 w-100 text-end" style="width: 80%">Total :</div>
                <div class="text-end" style="width: 20%">Rp.{{ number_format($data->total, 0, ',', '.') }}</div>
            </div>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        var path = '/{{ request()->path() }}';
        var table;

        function generateTable() {
            table = $('#table-data-cart').DataTable({
                ajax: {
                    type: 'GET',
                    url: path,
                    // 'data': data
                },
                "aaSorting": [],
                "order": [],
                scrollX: true,
                responsive: true,
                paging: true,
                "fnDrawCallback": function (setting) {
                },
                columns: [
                    {
                        className: 'dt-control middle-header',
                        orderable: false,
                        data: null,
                        render: function () {
                            return '<i class="bx bx-plus-circle"></i>';
                        }
                    },
                    {
                        data: 'menu',
                        orderable: false,
                        className: 'middle-header text-center',
                        render: function (data) {
                            let image = data['image'];
                            if (data !== null) {
                                return '<div class="w-100 d-flex justify-content-center">' +
                                    '<a href="' + image + '" target="_blank" class="box-product-image">' +
                                    '<img src="' + image + '" alt="product-image" />' +
                                    '</a>' +
                                    '</div>';
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'menu.name',
                        className: 'middle-header',
                    },
                    {
                        data: 'price',
                        className: 'text-end middle-header',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'qty',
                        className: 'text-center middle-header',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'total',
                        className: 'text-end middle-header',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                ],
            });
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
