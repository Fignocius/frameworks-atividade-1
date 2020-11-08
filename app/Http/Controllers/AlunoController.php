<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Curso;
use App\Models\Disciplina;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alunos = Aluno::paginate(5);

        return view('alunos.index', compact('alunos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cursos = Curso::all();
        return view('alunos.create', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required',
            'idCurso' => 'required'
        ]);

        Aluno::create($request->all());

        return redirect()->route('alunos.index')
        ->with('success', 'Aluno criado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function show(Aluno $aluno)
    {
       return view('alunos.show', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        return view('alunos.edit', compact('aluno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function disciplina(Aluno $aluno)
    {
        $curso = Curso::find($aluno->idCurso);
        return view('alunos.disciplina', compact('aluno'), compact('curso'));
    }

    /**
     * Edit disciplina the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function editDisciplina(Aluno $aluno, Disciplina $disciplina)
    {
        //$disciplina = Disciplina::find($disciplina);
        //$aluno = Aluno::find($aluno);
        return view('alunos.editDisciplina', compact('aluno'), compact('disciplina'));
    }

    /**
     * Update disciplina the form for editing the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function updateDisciplina(Request $request, Aluno $aluno, Disciplina $disciplina)
    {
        $request->validate([
            'semestre' => 'required',
            'situacao' => 'required',
        ]);
;
        $aluno->disciplinas()->updateExistingPivot($disciplina, [
            'semestre' => $request->semestre,
            'situacao'=> $request->situacao
        ], true);
        return redirect()->route('alunos.editDisciplina', ['aluno'=>$aluno, 'disciplina' => $disciplina])
        ->with('success', 'Disciplina atualizada com sucesso');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Aluno $aluno)
    {
        $request->validate([
            'nome' => 'required',
        ]);
        $aluno->update($request->all());

        return redirect()->route('alunos.index')
            ->with('success', 'Aluno atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy(Aluno $aluno)
    {
        $aluno->delete();
        return redirect()->route('alunos.index')
        ->with('success', 'Aluno deletado com sucesso');
    }

    /**
     * Adds disciplina the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function assignDisciplina(Request $request, Aluno $aluno)
    {
        $request->validate([
            'disciplina' => 'required',
            'semestre' => 'required',
            'situacao' => 'required',
        ]);

        $disciplina = Disciplina::find($request->disciplina);
        $aluno->disciplinas()->attach($disciplina, [
            'semestre' => $request->semestre,
            'situacao'=> $request->situacao
        ]);

        return redirect()->route('alunos.show', $aluno->id)
            ->with('success', 'Aluno atualizado com sucesso');
    }

     /**
     * Remove disciplina the specified resource in storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @param  \App\Models\Disciplina  $disciplina
     * @return \Illuminate\Http\Response
     */
    public function removeDisciplina(Aluno $aluno, Disciplina $disciplina)
    {
        $aluno->disciplinas()->detach($disciplina);

        return redirect()->route('alunos.show', $aluno->id)
            ->with('success', 'Disciplina removida com sucesso');
    }
}
