@extends('admin.layouts.sub')

@section('css')
@endsection

@section('mycss')
@endsection

@section('content')
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <h5>您好！{{ session('admin_info.real_name') ?: session('admin_info.account') }}，当前时间：{{ date('Y-m-d H:i:s') }}</h5>
        </div>
    </div>
@endsection

@section('js')
@endsection

@section('myjs')
@endsection
