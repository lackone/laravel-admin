@extends('admin.layouts.sub')

@section('content')
    <div class="min-vh-100 d-flex justify-content-center align-items-center bg-body-tertiary py-3">
        <div class="px-2">
            <div class="container-fluid">

                <div class="bsa-error-code">
                    403
                </div>
                <div class="bsa-error-text">{{ $msg }}</div>
            </div>
        </div>
    </div>
@endsection
