<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
//ficheiro criado atraves do comando <<php artisan make:controller ApiController>>



use App\Models\Student;// uma especie de import da classe Student
class ApiController extends Controller
{
      public function getAllStudents() {
        //Obter Todos os Estudantes
        $students = Student::get()->toJson(JSON_PRETTY_PRINT); //eloquent
        return response($students, 200);
      }
  
      public function createStudent(Request $request) {
        // obter dados atraves do endpoint e registar na base de dados
                $student = new Student;
                $student->name = $request->name;
                $student->course = $request->course;
                $student->save();

                return response()->json([
                    "messagem" => "Estudante Salvo Com Sucesso"
                ], 201);
      }
  
      public function getStudent($id) {
        //obter um estudante atraves do id
        if (Student::where('id', $id)->exists()) {
            $student = Student::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($student, 200);
          } else {
            return response()->json([
              "messagem" => "Estudante Nao Encontrado"
            ], 404);
          }
      }
  
      public function updateStudent(Request $request, $id) {
        // atualizar dados do estudante
        if (Student::where('id', $id)->exists()) {
            $student = Student::find($id);
            $student->name = is_null($request->name) ? $student->name : $request->name;
            $student->course = is_null($request->course) ? $student->course : $request->course;
            $student->save();
    
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
        
            if(Student::where('id', $id)->exists()) {
              $student = Student::find($id);
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
