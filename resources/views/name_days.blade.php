@section('content')
    <h1 @class('mt-5 text-center')>dnes je {{ $date }}, meniny ma <span @class('text-danger')>{{ $name }}</span></h1>
    <select id="name_days" type="text" class="form-control select2" ></select>
@endsection

@section('title', 'Meniny')

@extends('layouts.app')
