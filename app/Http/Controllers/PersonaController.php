<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use App\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class PersonaController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->fecha = Carbon::now();
    }

    public function index(){
        if(Auth::user()->perfil_id > 1){
            $personas = User::join('ciudad', 'users.ciudad_id', '=', 'ciudad.id')
                            ->join('perfil', 'users.perfil_id', '=', 'perfil.id')
                            ->select('users.*', 'ciudad.*', 'perfil.*', 'users.id as id_users')
                            ->where('users.id', Auth::user()->id)
                            ->get();
        }else{
            $personas = User::join('ciudad', 'users.ciudad_id', '=', 'ciudad.id')
                            ->join('perfil', 'users.perfil_id', '=', 'perfil.id')
                            ->select('users.*','ciudad.*', 'perfil.*', 'users.id as id_users')
                            ->get();
        }

        $pasatiempos = DB::table('pasatiempo')
                            ->join('pasatiempoxuser', 'pasatiempoxuser.pasatiempo_id', '=', 'pasatiempo.id')
                            ->select('pasatiempo.*', 'pasatiempoxuser.*', 'pasatiempo.id as id_pasatiempo', 'pasatiempoxuser.id as id_pasatiempoxuser')
                            // ->where([
                            //     ['pasatiempoxuser.users_id', Auth::user()->id],
                            // ])
                            ->distinct()
                            ->get();
        
        $pasatiemposG = DB::table('pasatiempo')
                            ->distinct()
                            ->orderBy('pasatiempo', 'asc')
                            ->get();

        
        return view('editUser', compact('personas', 'pasatiempos', 'pasatiemposG'));
    }

    public function update(Request $request){    
        $messages = [
            'nombreUser.required' => 'El campo nombre es obligatorio',
            'nombreUser.min' => 'El campo nombre debe tener un mínimo de 3 letras', 
            'nombreUser.max' => 'El campo nombre debe tener un máximo de 50 letras',  
            'nombreUser.alpha' => 'El campo nombre debe contener unicamente letras', 
            
            'usuarioUser.required' => 'El campo usuario es obligatorio', 
            'usuarioUser.min' => 'El campo usuario debe tener un mínimo de 3 letras', 
            'usuarioUser.max' => 'El campo usuario debe tener un máximo de 15 letras', 

            'emailUser.required' => 'El campo email es obligatorio',
            'nombreUser.email' => 'El campo email debe ser una dirección de correo válida', 
            'nombreUser.max' => 'El campo email debe tener un máximo de 255 letras',  
        ];

        $validator = Validator::make($request->all(), [
            'nombreUser' => ['required', 'alpha', 'min:3', 'max:50'],
            'usuarioUser' => ['required', 'string', 'min:2', 'max:15'],
            'emailUser' => ['required', 'string', 'email', 'max:255'],
            'perfilUser' => ['integer'],
            'ciudadUser' => ['integer']
        ], $messages);

        if ($validator->fails()){
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            User::where('id', '=', $request->id_users)
                ->update(['name' => $request->nombreUser, 'updated_at' => $this->fecha,
                          'username' => $request->usuarioUser, 'updated_at' => $this->fecha,
                          'email' => $request->emailUser, 'updated_at' => $this->fecha,
                          'perfil_id' => $request->perfilUser, 'updated_at' => $this->fecha,
                          'ciudad_id' => $request->ciudadUser, 'updated_at' => $this->fecha
                ]);

            return redirect('users')->with('status', 'Enhorabuena usuario editado correctamente');
        }
    }

    public function userSelect(Request $request){
        $personaSelect = DB::table('users')
                        ->where('id', '=', $request->filtro)
                        ->get();
                        
        return $personaSelect;
    }

    public function perfilSelect(Request $request){
        $perfilSelect = DB::table('perfil')
                        ->where('id', '=', $request->filtro)
                        ->get();
                        
        return $perfilSelect;
    }
    
    public function perfilSelected(Request $request){
        $perfilSelected = DB::table('perfil')
                        ->where('id', '<>', $request->filtro)
                        ->get();
                        
        return $perfilSelected;
    }

    public function ciudadSelect(Request $request){
        $ciudadSelect = DB::table('ciudad')
                        ->where('id', '=', $request->filtro)
                        ->get();
                        
        return $ciudadSelect;
    }

    public function ciudadSelected(Request $request){
        $perfilSelected = DB::table('ciudad')
                        ->where('id', '<>', $request->filtro)
                        ->get();
                        
        return $perfilSelected;
    }
}