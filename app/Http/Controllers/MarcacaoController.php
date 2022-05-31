<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//ficheiro criado atraves do comando <<php artisan make:controller ApiController>>



use App\Models\Marcacao;// uma especie de import da classe Student
class MarcacaoController extends Controller
{
      public function getAllMarcacao() {
        //Obter Todos os Estudantes
        $marc = Marcacao::get()->toJson(JSON_PRETTY_PRINT); //eloquent
        return response($marc, 200);
      }
  
      public function createMarcacao(Request $request) {
        // obter dados atraves do endpoint e registar na base de dados
                $marc = new Marcacao();
                $marc->id_aluno = $request->id_aluno;
                $marc->estado = $request->estado;
                $marc->id_educadora = $request->id_educadora;
                $marc->data_marcacao = $request->data_marcacao;
                $marc->tipo_marcacao = $request->tipo_marcacao;
                $marc->save();

                return response()->json([
                    "messagem" => "Maracao Feita Com Sucesso"
                ], 201);
      }
  
      public function getMarcacao($id) {
        //obter um estudante atraves do id
        if (Marcacao::where('id', $id)->exists()) {
            $marc = Marcacao::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($marc, 200);
          } else {
            return response()->json([
              "messagem" => "Marcacao Nao Encontrada"
            ], 404);
          }
      }
      
        
        
}
