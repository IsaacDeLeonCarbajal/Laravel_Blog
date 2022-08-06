@extends('layouts.master')

@section('title', 'Administración')

@section('content-center')
    <h1>Administrar</h1>

    <h3>Usuarios</h3>

    <table class="table table-sm table-striped table-hover border">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Permisos</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($usuarios as $usu)
                <tr>
                    <td>{{ $usu->apellido_paterno }} {{ $usu->apellido_materno }} {{ $usu->nombre }}</td>
                    <td>Usuario | 
                        @foreach($usu->roles->pluck('rol')->toArray() as $r)
                            {{ucwords($r)}} |
                        @endforeach
                    </td>
                    <td><a class="btn btn-primary py-0" href="{{route('usuarios.edit', $usu)}}">Editar</a></td>
                </tr>
            @endforeach
        </tbody>

    </table>

    {{ $usuarios->links() }}
@endsection
