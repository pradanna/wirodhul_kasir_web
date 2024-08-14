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
                        <li class="breadcrumb-item "><a href="#">Data members</a></li>
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
                            <p class="title">Diskon Member</p>

                        </div>
                        <div class="d-flex">
                            <div class="mb-2">
                                <label class="control-label" for="diskon">Diskon</label>

                                <div class="d-flex align-items-center">
                                    <input type="text" id="diskon" class="form-control " placeholder="diskon"
                                        value="" />
                                    <span class="me-2 ms-1" style="font-size: 1rem">%</span>

                                    <a class="bt-primary"> UPDATE</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                        <th>Id Member</th>
                                        <th>Nama</th>
                                        <th>Nomor Hp</th>
                                        <th>Alamat</th>
                                        <th style="width: 100px;">Action</th>
                                        {{-- detail, ubah status pesanan --}}
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>#</th>
                                        <th>Id Member</th>
                                        <th>Nama</th>
                                        <th>Nomor Hp</th>
                                        <th>Alamat</th>
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
                                <p class="title">Tambah Member</p>
                            </div>

                            <input type="hidden" id="id" name="id">

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="m-nama" name="nama"
                                    placeholder="Nama Lengkap Member">
                                <label for="m-nama" class="form-label">Nama Member</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="m-nohp" name="nohp"
                                    placeholder="Nomor HP Member">
                                <label for="m-nohp" class="form-label">Nomor HP</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="m-deskripsi" name="Alamat"
                                    placeholder="Alamat Member">
                                <label for="m-Alamat" class="form-label">Alamat</label>
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
