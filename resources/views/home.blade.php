@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class='container'>
                    <div class='row'>
                        <div class="col-sm" align-content: normal;>
                            <div class="card text-white bg-warning mb-3 mx-auto home-card">
                                <div class="card-body">
                                    <h5 class="card-title">Camisetas activas</h5>
                                    <p class="card-text">{{$activas}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card text-white bg-primary mb-3 mx-auto home-card">
                                
                                <div class="card-body">
                                    <h5 class="card-title">Pedidos totales</h5>
                                    <p class="card-text">{{$pedidos}}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="card text-white bg-info mb-3 mx-auto home-card">
                                <div class="card-body">
                                    <h5 class="card-title">Clientes totales</h5>
                                    <p class="card-text">{{$clientes}}</p>
                                </div>
                            </div>
                        </div>  
                </div>
            </div>
        </div>
    </div>
@endsection
