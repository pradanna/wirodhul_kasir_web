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
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
                </ol>
            </nav>
        </div>

        <div class="card-content">
            <div class="content-header mb-3">
                <p class="header-title">Data Penjualan Hari Ini</p>
            </div>
            <hr class="custom-divider"/>
            <table id="table-data" class="display table w-100">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th width="10%" class="text-center">Tanggal</th>
                    <th width="5%" class="text-center">No. Penjualan</th>
                    <th width="5%" class="text-center">Member</th>
                    <th width="5%" class="text-center">Sub Total</th>
                    <th width="5%" class="text-center">Diskon</th>
                    <th width="5%" class="text-center">Total</th>
                    <th width="10%" class="text-center">Detail</th>
                </tr>
                </thead>
            </table>
            <hr class="custom-divider"/>
            <div class="text-end mt-3">
                <span class="mr-2 font-weight-bold">Total Pendapatan : </span>
                <span class="font-weight-bold" id="lbl-total">Rp. 0</span>
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
            table = $('#table-data').DataTable({
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
                    let data = this.fnGetData();
                    let total = data.map(item => item['total']).reduce((prev, next) => prev + next, 0);
                    $('#lbl-total').html('Rp. ' + total.toLocaleString('id-ID'));
                },
                columns: [
                    {
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex',
                        searchable: false,
                        orderable: false,
                        className: 'text-center middle-header',
                    },
                    {
                        data: 'date',
                        className: 'middle-header',
                    },
                    {
                        data: 'no_reference',
                        className: 'middle-header',
                    },
                    {
                        data: 'member',
                        className: 'middle-header',
                        render: function (data) {
                            if (data !== null) {
                                return data['username'];
                            }
                            return '-';
                        }
                    },
                    {
                        data: 'sub_total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'discount',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: 'total',
                        className: 'middle-header text-end',
                        render: function (data) {
                            return data.toLocaleString('id-ID');
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlDetail = path + '/' + id;
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a style="color: var(--dark-tint)" href="' + urlDetail + '" class="btn-table-action" data-id="' + id + '"><span class="material-symbols-outlined" style="font-size: 1em">more_vert</span></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
