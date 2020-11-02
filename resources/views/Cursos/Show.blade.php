@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> {{ $curso->nome}} </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('cursos.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $curso->nome}}
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <strong> Disciplinas cadastradas </strong>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('disciplinas.create') }}" title="vincular disciplina"> <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
    @foreach ($curso->disciplinas as $disciplina)
        <div class="col-xs-12 col-sm-12 col-md-12">
                {{ $disciplina->nome }}
        </div>
    @endforeach
    </div>
@endsection