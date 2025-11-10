@extends('backend.layouts.backend_layout')

@section('content')
    @yield('breadcrumbs')
    <div class="row">
        @include('backend.setting.sidebar')
        
        @yield('setting_content')
    </div>
@endsection