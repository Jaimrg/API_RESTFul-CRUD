<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//ficheiro criado atraves do comando <<php artisan make:controller ApiController>>



use App\Models\Aluno;// uma especie de import da classe Student
class AlunosController extends Controller
{
      public function getAllStudents() {
        //Obter Todos os Estudantes
        $students = Aluno::get()->toJson(JSON_PRETTY_PRINT); //eloquent
        return response($students, 200);
      }
  
      public function createStudent(Request $request) {
        // obter dados atraves do endpoint e registar na base de dados
                $student = new Aluno;
                $student->nome = $request->nome;
                $student->idade = $request->idade;
                $student->sexo = $request->sexo;
                $student->bairro = $request->bairro;
                $student->estado = $request->estado;
                $student->save();

                return response()->json([
                    "messagem" => "Estudante Salvo Com Sucesso"
                ], 201);
      }
  
      public function getStudent($id) {
        //obter um estudante atraves do id
        if (Aluno::where('id', $id)->exists()) {
            $student = Aluno::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "messagem" => "Estudante Nao Encontrado"
            ], 404);
          }
      }
  
      public function updateStudent(Request $request, $id) {
        // atualizar dados do estudante
        if (Aluno::where('id', $id)->exists()) {
            $student = Aluno::find($id);
            $student->nome = is_null($request->nome) ? $student->nome : $request->nome;
            $student->idade = is_null($request->idade) ? $student->idade : $request->idade;
            $student->sexo = is_null($request->sexo) ? $student->sexo : $request->sexo;
            $student->bairro = is_null($request->bairro) ? $student->bairro : $request->bairro;
            $student->estado = is_null($request->estado) ? $student->estado : $request->estado;

           /* $student->nome =  $request->nome;
            $student->idade =  $request->idade;
            $student->sexo =  $request->sexo;
            $student->bairro =  $request->bairro;
            $student->estado =  $request->estado;*/
            $student->save();
            echo $request->nome;
            return response()->json([
                "messagem" => "Dados Atualizados Com Sucesso"
            ], 200);
            } else {
            return response()->json([
                "messagem" => "Estudante Nao Encontrado"
            ], 404);
        } 
      }
  
      public function deleteStudent ($id) {
        //Excluir Estudante
        
            if(Aluno::where('id', $id)->exists()) {
              $student = Aluno::find($id);
              $student->delete();
      
              return response()->json([
                "messagem" => "Registros Excluidos"
              ], 202);
            } else {
              return response()->json([
                "messagem" => "Estudante Nao Encontrado"
              ], 404);
            }
          
      }
}
