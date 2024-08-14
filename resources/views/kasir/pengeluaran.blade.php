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
                    <ol class="breadcrumb mb-0 ">
                        <li class="breadcrumb-item "><a href="#">Data Pengeluaran</a></li>
                    </ol>
                </nav>

                <div class="d-flex align-items-center " style="color: gray">
                    <span class="material-symbols-outlined me-2 ">
                        error
                    </span><span>Jika ada pertanyaan, silahkan hubungi admin</span>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="menu-container">
                    <div class="menu overflow-hidden">
                        <div class="title-container">
                            <p class="title">Data pengeluaran</p>
                        </div>
                        <div class="table-responsive">
                            <table id="tabel" class="table table-striped" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nota Pengeluaran</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>total</th>
                                        <th style="width: 100px;">Action</th>
                                        {{-- detail, ubah status pesanan --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Nota Pengeluaran</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>total</th>
                                        <th>Action</th>
                                        {{-- detail, ubah status pesanan --}}
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="menu-container">
                    <div class="menu overflow-hidden">
                        <form onsubmit="return saveForm()" id="form">
                            @csrf
                            <div class="title-container">
                                <p class="title">Tambah pengeluaran</p>
                            </div>

                            <input type="hidden" id="id" name="id">

                            <div class=" mb-3">
                                <label class="form-label">Nota Pengeluaran</label>

                                <input type="file" id="image1" name="image" class="image" data-min-height="10"
                                    data-heigh="400" accept="image/jpeg, image/jpg, image/png"
                                    data-allowed-file-extensions="jpg jpeg png webp" />
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Tanggal</label>
                                <input type="date" class="form-control" id="tanggal">
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="p-deskripsi" name="deskripsi"
                                    placeholder="Deskripsi Singkat">
                                <label for="p-deskripsi" class="form-label">keterangan</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="p-harga" name="harga"
                                    placeholder="Harga">
                                <label for="p-harga" class="form-label">Total</label>
                            </div>
                            <div class="d-flex justify-content-between gap-2">
                                <button type="button" class="btn-warning-sm w-100 text-center "
                                    onclick="clearData()">Clear</button>
                                <button type="submit" class="bt-primary  w-100 ">Simpan Perubahan</button>
                            </div>
                        </form>
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
