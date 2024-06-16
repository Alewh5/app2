@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-lg-3 col-xs-6">
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3>Nuevo proyecto</h3>
                <p>Hacer un CRUD de usuarios usando jQuery Datatable.</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="{{ route('users.index') }}" class="small-box-footer">Más información<i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
@endsection
