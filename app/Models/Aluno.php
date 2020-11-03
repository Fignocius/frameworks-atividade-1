<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    use HasFactory;

    protected $table = 'aluno';

    public $timestamps = false;

    protected $fillable = [
        'nome',
        'idCurso'
    ];

    public function disciplinas()
    {
        return $this->belongsToMany('App\Models\Disciplina', 'aluno_disciplina', 'idAluno', 'idDisciplina')
        ->withPivot('semestre', 'situacao');
    }
}
