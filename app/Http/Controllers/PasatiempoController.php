<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Pasatiempo;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PasatiempoController extends Controller{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
        $this->fecha = Carbon::now();
    }

    public function create(Request $request){
        $messages = [
            'newPasatiempo.required' => 'El campo del pasatiempo es obligatorio',
            'newPasatiempo.alpha' => 'El campo del pasatiempo debe contener unicamente letras',
            'newPasatiempo.min' => 'El campo del pasatiempo debe tener un mínimo de 3 letras', 
            'newPasatiempo.max' => 'El campo del pasatiempo debe tener un máximo de 50 letras',        
        ];

        $validator = Validator::make($request->all(), [
            'newPasatiempo' => ['required', 'alpha', 'min:3', 'max:50']
        ], $messages);

        if ($validator->fails()){
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            Pasatiempo::insert([
                ['pasatiempo' => $request->newPasatiempo, 'created_at' => $this->fecha, 'updated_at' => $this->fecha]
            ]);

            return redirect('users')->with('status', 'Enhorabuena Pasatiempo creado correctamente');
        }
    }

    public function insert(Request $request){
        $messages = [
            'pasatiempoUserIdAgg.required' => 'El campo del pasatiempo es obligatorio',
            'newPasatiempo.integer' => 'El campo del pasatiempo debe ser un número entero'
        ];

        $validator = Validator::make($request->all(), [
            'pasatiempoIdAgg' => ['required', 'integer'],
            'pasatiempoUserIdAgg' => ['required', 'integer'],
        ], $messages);

        if ($validator->fails()){
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            DB::table('pasatiempoxuser')->insert([
                ['pasatiempo_id' => $request->pasatiempoIdAgg, 'users_id' => $request->pasatiempoUserIdAgg, 'created_at' => $this->fecha, 'updated_at' => $this->fecha]
            ]);

            return redirect('users')->with('status', 'Enhorabuena Pasatiempo agregado correctamente');
        }
    
    
    }

    public function update(Request $request){
        $messages = [
            'pasatiempoUpdate.required' => 'El campo del pasatiempo es obligatorio',
            'pasatiempoUpdate.string' => 'El campo del pasatiempo debe contener unicamente letras',
            'pasatiempoUpdate.min' => 'El campo del pasatiempo debe tener un mínimo de 2 letras',        
        ];
        
        $validator = Validator::make($request->all(), [
            'idUpdatePasatiempo' => ['required', 'integer'],
            'pasatiempoUpdate' => ['required', 'string', 'min:2'],
        ], $messages);

        if ($validator->fails()){
            return redirect('users')
                        ->withErrors($validator)
                        ->withInput();
        } else {
            Pasatiempo::where('id', '=', $request->idUpdatePasatiempo)
                 ->update(['pasatiempo' => $request->pasatiempoUpdate, 'updated_at' => $this->fecha]);

            return redirect('users')->with('status', 'Enhorabuena pasatiempo editado correctamente');
        }
    }

    public function destroy(Request $request){
        DB::table('pasatiempoxuser')
          ->where('id', '=', $request->pasatiempoIdDelete)
          ->where('users_id', '=', $request->idDeletePasatiempo)
          ->delete();

        return redirect('users')->with('status', 'Enhorabuena pasatiempos eliminado');
    }

    public function pasatiempoSelect(Request $request){
        $pasatiempoSelect = Pasatiempo::where('id', '=', $request->filtro)
                                      ->get();
                        
        return $pasatiempoSelect;
    }
}