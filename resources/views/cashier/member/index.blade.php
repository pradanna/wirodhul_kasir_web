@extends('base')

@section('morecss')
    <link rel="stylesheet" href="{{ asset('/css/custom.style.css') }}">
@endsection
@section('content')
    <div class="dashboard">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Member</p>
                <p class="content-sub-title">Manajemen data member</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('cashier.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Member</li>
                </ol>
            </nav>
        </div>

        <div class="card-content">
            <div class="content-header mb-3">
                <p class="header-title">Data Member</p>
                <a href="{{ route('cashier.member.add') }}" class="btn-add">
                    <i class="material-symbols-outlined" style="font-size: 0.8em;">add</i>
                    <span>Tambah Member</span>
                </a>
            </div>
            <hr class="custom-divider"/>
            <table id="table-data" class="display table w-100">
                <thead>
                <tr>
                    <th width="5%" class="text-center">#</th>
                    <th>Username</th>
                    <th width="15%">No. HP</th>
                    <th width="10%" class="text-center">Aksi</th>
                </tr>
                </thead>
            </table>
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
                    eventDelete();
                },
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', searchable: false, orderable: false, className: 'text-center middle-header',},
                    {
                        data: 'username',
                        className: 'middle-header',
                    },
                    {
                        data: 'phone',
                        className: 'middle-header text-center',
                    },
                    {
                        data: null,
                        orderable: false,
                        className: 'text-center middle-header',
                        render: function (data) {
                            let id = data['id'];
                            let urlEdit = path + '/' + id + '/edit';
                            return '<div class="w-100 d-flex justify-content-center align-items-center gap-1">' +
                                '<a href="#" class="btn-table-action-delete" data-id="' + id + '"><i class="material-symbols-outlined">delete</i></a>' +
                                '<a href="' + urlEdit + '" class="btn-table-action-edit"><i class="material-symbols-outlined">edit</i></a>' +
                                '</div>';
                        }
                    }
                ],
            });
        }

        function eventDelete() {
            $('.btn-table-action-delete').on('click', function (e) {
                e.preventDefault();
                let id = this.dataset.id;
                AlertConfirm('Konfirmasi', 'Apakah anda yakin ingin menghapus data?', function () {
                    let url = path + '/' + id + '/delete';
                    BaseDeleteHandler(url, id);
                })
            })
        }

        $(document).ready(function () {
            generateTable();
        })
    </script>
@endsection
