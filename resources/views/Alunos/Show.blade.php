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
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> 
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
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
        <div class="col-xs-3 col-sm-3 col-md-3">Disciplina</div>
        <div class="col-xs-3 col-sm-3 col-md-3">Semestre</div>
        <div class="col-xs-3 col-sm-3 col-md-3">Situação</div>
        <div class="col-xs-3 col-sm-3 col-md-3">Açoes</div>
    </div>
    @foreach ($aluno->disciplinas as $disciplina)
    <form action="{{ route('alunos.removeDisciplina',['aluno'=> $aluno,'disciplina' => $disciplina]) }}" method="POST">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="col-xs-3 col-sm-3 col-md-3">{{ $disciplina->nome }}</div>
            <div class="col-xs-3 col-sm-3 col-md-3">{{ $disciplina->pivot->semestre }}</div>
            <div class="col-xs-3 col-sm-3 col-md-3">{{ $map[$disciplina->pivot->situacao] }}</div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                @csrf
                @method('DELETE')
                <button type="submit" title="delete" style="border: none; background-color:transparent;">
                    <i class="fas fa-trash fa-lg text-danger"></i>
                </button>
            </div>
        </div>
    </form>
    @endforeach
    </div>
@endsection