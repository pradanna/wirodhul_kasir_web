@extends('kasir.base')

@section('morecss')
    {{-- DROPZONE --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endsection
@section('content')
    <div class="dashboard">
        <div class="menu-container">
            <div class="menu d-flex justify-content-between ">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="me-5">

                    <div class="title-container">
                        <div>
                            <div class="d-flex">
                                <!-- Input Tanggal Mulai -->
                                <div class="me-2">
                                    <label for="startDate" class="form-label">Tanggal Mulai</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div>

                                <!-- Input Tanggal Akhir -->
                                <div class="me-2">
                                    <label for="endDate" class="form-label">Tanggal Akhir</label>
                                    <input type="date" class="form-control" id="endDate">
                                </div>

                                <!-- Tombol Cari -->
                                <div class="align-self-end">
                                    <button class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <a class="bt-primary d-flex" target="_blank" href="/kasir/cetak-laporan-pengeluaran"><span
                            class="material-symbols-outlined me-2">
                            print
                        </span>Cetak</a>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="menu-container">
                    <div class="menu overflow-hidden">
                        <div class="title-container">
                            <p class="title">Laporan Pengeluaran</p>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto Nota</th>
                                        <th>keterangan</th>
                                        <th>Tanggal</th>
                                        <th>total</th>
                                        {{-- detail, ubah status pesanan --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Foto Nota</th>
                                        <th>keterangan</th>
                                        <th>Tanggal</th>
                                        <th>total</th>
                                        {{-- detail, ubah status pesanan --}}
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('morejs')
    <script>
        $(document).ready(function() {
            setImgDropify('image1');
        });

        show_datatable();

        function show_datatable() {
            let colums = [{
                    className: "text-center",
                    orderable: false,
                    defaultContent: "",
                    searchable: false
                },
                {
                    // data: 'public_health_center.name', name: 'public_health_center.name'
                    data: 'image',
                    name: 'image',
                    render: function(data, x, row) {
                        return '<img  src="https://yousee-indonesia.com' + row.image + '" height="50" alt="img"/>'
                    }
                },
                {
                    data: 'name',
                    name: 'name',
                },
                {
                    className: "text-center",
                    data: 'id',
                    name: 'id',
                    orderable: false,
                    searchable: false,
                    render: function(data, x, row) {
                        return '<div class="d-flex justify-content-between gap-1">' +
                            '       <a class="btn-warning-sm" id="editData" data-image="' + row.image +
                            '" data-name="' + row.name + '" data-id="' + data + '">Ubah</a>' +
                            '       <a class="btn-danger-sm deletebutton" id="deleteData" data-name="' + row.name +
                            '" data-id="' + data + '">Hapus</a>' +
                            '</div>'
                    }
                },
            ];
        }
    </script>
@endsection
