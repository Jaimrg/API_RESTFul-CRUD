<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aluno;
use App\Models\Marcacao;
use Illuminate\Support\Facades\DB;

class MarcacaoAlunoController extends Controller
{  
  function index()
  {
    $data = Aluno::join('marcacao', 'marcacao.id_aluno', '=', 'aluno.id')->get(['aluno.nome', 'aluno.idade', 'aluno.sexo', 'aluno.bairro', 'marcacao.id_educadora', 'marcacao.tipo_marcacao', 'marcacao.created_at', 'marcacao.estado', 'marcacao.id_aluno']);
    return response($data, 200);
  }

  public function getNaoMarcado($tipo_marcacao)
  {          
    //$data = DB::select("SELECT aluno.id,aluno.nome FROM aluno WHERE aluno.id NOT IN (SELECT marcacao.id_aluno FROM marcacao WHERE marcacao.tipo_marcacao=$tipo_marcacao");
    //$data = DB::select("SELECT aluno.id,aluno.nome FROM aluno WHERE aluno.id NOT IN (SELECT marcacao.id_aluno FROM marcacao WHERE marcacao.tipo_marcacao='Saida de Casa'");                                                    
    $data =Aluno::select('id','nome')->whereNOTIn('id',function($query) use ($tipo_marcacao){      
      $query->select('id_aluno')->from('marcacao')->where('tipo_marcacao','=',"$tipo_marcacao");
    })->get()->toJson(JSON_PRETTY_PRINT);

    
    /*$data=(object)collect($array)->reject(function($item){
      // do something
    })->all();*/
    return response($data, 200);
  }

  public function getMark($id)
  {
    //obter um estudante atraves do id
    if (Aluno::where('id', $id)->exists()) {
      $data = Aluno::join('marcacao', 'marcacao.id_aluno', '=', 'aluno.id')->where('marcacao.id_aluno', '=', $id)->get(['aluno.nome', 'aluno.idade', 'aluno.sexo', 'aluno.bairro', 'marcacao.id_educadora', 'marcacao.tipo_marcacao', 'marcacao.created_at', 'aluno.estado', 'marcacao.id_aluno']);
      return response($data, 200);
    } else {
      return response()->json([
        "messagem" => "Marcacao Nao Encontrada"
      ], 404);
    }
  }
}
