@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2> Aluno </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alunos.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Nome:</strong>
                {{ $aluno->nome}}
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <strong> Disciplinas cadastradas </strong>
        <div class="pull-right">
            <a class="btn btn-success" href="{{ route('alunos.disciplina', $aluno->id) }}" title="vincular disciplina"> <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>
    @php
        $map = array('0'=>'Em curso', '1'=>'Aprovado', '2'=>'Reprovado', '3'=>'Trancado');
    @endphp
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="col-xs-4 col-sm-4 col-md-4">Disciplina</div>
        <div class="col-xs-4 col-sm-4 col-md-4">Semestre</div>
        <div class="col-xs-4 col-sm-4 col-md-4">Situação</div>
    </div>
    @foreach ($aluno->disciplinas as $disciplina)
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-4 col-sm-4 col-md-4">{{ $disciplina->nome }}</div>
            <div class="col-xs-4 col-sm-4 col-md-4">{{ $disciplina->pivot->semestre }}</div>
            <div class="col-xs-4 col-sm-4 col-md-4">{{ $map[$disciplina->pivot->situacao] }}</div>
        </div>
    @endforeach
    </div>
@endsection