@extends('layouts.master')

@section('title', 'ERROR')

@section('content-center')
    <h1 class="mb-3 text-danger">Ha ocurrido un error!</h1>

    <div class="alert alert-danger mt-2">
        {{$mensaje}}
    </div>
@endsection
