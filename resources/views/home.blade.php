@extends('layouts.app')

@section('title', 'Panel Principal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Bienvenido</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h4>¡Has iniciado sesión correctamente!</h4>
                    
                    <p>Bienvenido/a a tu panel de control. ¿Qué deseas hacer?</p>

                    <a href="{{ route('perfil') }}" class="btn btn-primary">Ver Perfil</a>
                    <a href="{{ route('logout') }}" class="btn btn-danger"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Cerrar Sesión
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
