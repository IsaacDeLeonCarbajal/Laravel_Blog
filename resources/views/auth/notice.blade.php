@extends('layouts.master')

@section('title', 'Verificar la cuenta')

@section('content-center')
    <h1 class="mb-3">Verificación de la cuenta</h1>

    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            Se ha enviado un link de verficación a tu correo.
        </div>
    @endif

    <p>
        Antes de continuar, por favor busca un link de verificación en tu correo.
    </p>
    <form action="{{ route('verification.resend') }}" method="POST" class="d-inline">
        @csrf

        <label>Si no recibiste uno, da</label>

        <button type="submit" class="d-inline btn btn-link p-0">
            click aquí
        </button>

        <label>para solicitar uno nuevo</label>
    </form>
@endsection
