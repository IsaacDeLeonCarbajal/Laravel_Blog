@extends('layouts.master')

@section('title')
    Usuario {{ $usuario->nombre }}
@endsection

@section('content')
    <h1>Mostrar al usuario {{ $usuario->nombre }}</h1>
@endsection
