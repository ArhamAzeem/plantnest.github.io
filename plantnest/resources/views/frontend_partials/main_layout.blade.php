@extends('frontend_partials.layout')

@section('app_content')
@includeIf('frontend_partials.nav')

@yield('main_content')

@endsection