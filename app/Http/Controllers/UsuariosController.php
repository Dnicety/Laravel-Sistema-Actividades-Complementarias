<?php
namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Actividad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class UsuariosController extends Controller
{
    
    public function export(){
        if(Auth::user()->tipo == 'ADMIN'){
            return Excel::download(new UsersExport('ADMIN'), 'usuarios.csv');    
        }
        return Excel::download(new UsersExport(Auth::user()->departamento), 'usuarios.csv');
    }

    public function index(){
        switch(Auth::user()->tipo){
            case 'ADMIN':
                $usuarios = User::get();    
                break;
            case 'JEFEDEPTO':
                $usuarios = DB::select('SELECT * FROM users WHERE departamento = ? AND tipo = ?', [Auth::user()->departamento, 'PRESTADOR']);
                break;
        }
        return view('usuarios.usuarios', compact('usuarios'));
    }

    public function create(){
        $departamentos = DB::select('SELECT * FROM departamentos');
        return view("usuarios.newusuario", compact('departamentos'));
    }

    public function store(Request $request){
        if(DB::select('SELECT * FROM users WHERE email = ?', [$request->email])){
            return back()->withErrors('El correo que intenta utilizar ya pertenece a otro usuario');
        }
        else{
            $usuarios = new User();
            $usuarios->name = $request->name;
            $usuarios->email = $request->email;
            $usuarios->password = Hash::make($request->password);
            $usuarios->institucion = $request->institucion;
            $usuarios->departamento = $request->departamento;
            $usuarios->telefono = $request->telefono;
            $usuarios->tipo = $request->tipo;
            $usuarios->sexo = $request->sexo;
            $usuarios->docente = $request->docente;
            $usuarios->save();
            return redirect()->route('usuarios.index')->withSuccess('Usuario creado exitosamente!');;       
        }
    }

    public function show($id)
    {
        $usuarios = User::findorfail($id);
        $actividades = Actividad::paginate();
        return view('usuarios.showusuario', compact('usuarios', 'actividades'));
    }

    public function showProfile(){
        return view('usuarios.showperfil');
    }

    public function edit($id)
    {
        $usuarios = User::findOrFail($id);
        $departamentos = DB::select('SELECT * FROM departamentos');
        return view('usuarios.editusuario', compact('usuarios', 'departamentos'));
    }

    public function update(Request $request, $id)
    {
        $usuarios = User::findorfail($id);
        $usu = User::where('email', $request->email)->get();
        if($usu){
            if($usuarios->email == $usu[0]->email){
                if($usuarios->id == $usu[0]->id){
                    $usuarios->name = $request->name;
                    $usuarios->email = $request->email;
                    $usuarios->institucion = $request->institucion;
                    $usuarios->departamento = $request->departamento;
                    $usuarios->telefono = $request->telefono;
                    $usuarios->tipo = $request->tipo;
                    $usuarios->sexo = $request->sexo;
                    $usuarios->docente = $request->docente;
                    $usuarios->save();
                    return redirect()->route('usuarios.index')->withSuccess('Usuario editado exitosamente!');       
                } else {
                    return back()->withErrors('El correo que intenta utilizar ya pertenece a otro usuario');
                }
            } else {
                return back()->withErrors('El correo que intenta utilizar ya pertenece a otro usuario');
            }
        } else {
            $usuarios->name = $request->name;
            $usuarios->email = $request->email;
            $usuarios->institucion = $request->institucion;
            $usuarios->departamento = $request->departamento;
            $usuarios->telefono = $request->telefono;
            $usuarios->tipo = $request->tipo;
            $usuarios->sexo = $request->sexo;
            $usuarios->docente = $request->docente;
            $usuarios->save();
            return redirect()->route('usuarios.index')->withSuccess('Usuario editado exitosamente!'); 
        }
    }

    public function passwordEdit(Request $request, $id){
        $passwordold = DB::select('SELECT u.password FROM users AS u WHERE u.id = ?', [$id]);
        if(Hash::check($request->passwordold , $passwordold[0]->password)){
            DB::update('UPDATE users AS u SET u.password = ? WHERE id = ?', [Hash::make($request->passwordnew) ,$id]);
            return redirect()->route('usuarios.index')->withSuccess('Cambio de contraseña existoso!');
        } else {
            return back()->withErrors('Contarseña anterior incorrecta');
        }
    }


    // Modulo no integrado
    public function updateFirma(Request $request, $id){
        $request->validate([
            'file' => 'required|image|max:2048'
        ]);
        $path = $request->file('file')->store('public/firma');
        $url = Storage::url($path);
        DB::update('UPDATE users SET firma = ? where id = ?', [$url, $id]);
        return redirect()->route('perfil');
    }

    public function destroy($id){
        if(DB::select('SELECT * FROM actividads WHERE prestador = ?', [$id])){
            return back()->withErrors('Ocurrio un error no se puede eliminar el usuario ya se le asigno una actividad');
        }
        User::destroy($id);
        return back()->withSuccess('Usuario eliminado exitosamente!');
    }

}
