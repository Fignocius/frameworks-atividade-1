@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Editar disciplina</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('alunos.show', $aluno->id) }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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
   <form action="{{ route('alunos.updateDisciplina', ['aluno'=>$aluno, 'disciplina'=>$disciplina]) }}" method="POST" >
        @csrf

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <div class="row py-xl-4">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <strong>Disciplina:</strong>
                            <input type="text" name="nome" class="form-control" value="{{$disciplina->nome}}" disabled/>
                        </div>
                    </div>
                    <div class="row py-4">
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <input type="text" name="semestre" class="form-control" value="{{$aluno->disciplinas[$disciplina->id - 1]->pivot->semestre}}" placeholder="semestre" />
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <select name="situacao" class="form-control" value="" required>
                                    <option value="0">Em curso</option>
                                    <option value="1">Aprovado</option>
                                    <option value="2">Reprovado</option>
                                    <option value="3">Trancado</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Adicionar</button>
            </div>
        </div>
    </form>
@endsection