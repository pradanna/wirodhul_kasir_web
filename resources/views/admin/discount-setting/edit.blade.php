@extends('base')

@section('morecss')
    <link rel="stylesheet" href="{{ asset('/css/custom.style.css') }}">

@endsection
@section('content')
    @if (\Illuminate\Support\Facades\Session::has('failed'))
        <script>
            Swal.fire("Ooops", '{{ \Illuminate\Support\Facades\Session::get('failed') }}', "error")
        </script>
    @endif
    @if (\Illuminate\Support\Facades\Session::has('success'))
        <script>
            Swal.fire({
                title: 'Success',
                text: '{{ \Illuminate\Support\Facades\Session::get('success') }}',
                icon: 'success',
                timer: 700
            }).then(() => {
                window.location.href = '{{ route('admin.discount') }}';
            })
        </script>
    @endif
    <div class="dashboard">
        <div class="d-flex justify-content-between align-items-center mb-1">
            <div>
                <p class="content-title">Setting Diskon</p>
                <p class="content-sub-title">Manajemen data setting diskon</p>
            </div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.discount') }}">Setting Diskon</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit</li>
                </ol>
            </nav>
        </div>

        <div class="card-content">
            <form method="post" id="form-data">
                @csrf
                <div class="w-100 mb-3">
                    <label for="nominal" class="form-label input-label">Minimal Pembelian <span
                            class="color-danger">*</span></label>
                    <input type="number" placeholder="" class="text-input" id="nominal"
                           name="nominal" value="{{ $data->nominal }}">
                    @if($errors->has('nominal'))
                        <span id="nominal-error" class="input-label-error">
                        {{ $errors->first('nominal') }}
                    </span>
                    @endif
                </div>
                <div class="w-100 mb-3">
                    <label for="discount" class="form-label input-label">Diskon %<span
                            class="color-danger">*</span></label>
                    <input type="number" placeholder="" class="text-input" id="discount"
                           name="discount" value="{{ $data->discount }}">
                    @if($errors->has('discount'))
                        <span id="discount-error" class="input-label-error">
                        {{ $errors->first('discount') }}
                    </span>
                    @endif
                </div>
                <hr class="custom-divider"/>
                <div class="d-flex align-items-center justify-content-end w-100">
                    <a href="#" class="btn-add" id="btn-save">
                        <i class="material-symbols-outlined">check</i>
                        <span>Simpan</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('morejs')
    <script src="{{ asset('/js/helper.js') }}"></script>
    <script>
        function eventSave() {
            $('#btn-save').on('click', function (e) {
                e.preventDefault();
                AlertConfirm('Konfirmasi!', 'Apakah anda yakin ingin menyimpan data?', function () {
                    $('#form-data').submit();
                })
            })
        }

        $(document).ready(function () {
            eventSave();
        })
    </script>
@endsection
