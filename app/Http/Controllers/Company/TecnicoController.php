<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Tecnico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TecnicoController extends Controller
{

    public function index() {
        
        $tecnicos = Tecnico::orderBy('id', 'desc')->paginate(10);
        return view('company.pages.technicals.index', compact('tecnicos') );
    }
    
    public function store(Request $request)
    {

        $tecnicoId = $request->tecnicoId;

        $validator = Validator::make($request->all(), [
            'nombre' => 'required', 
            // 'numero_de_documento' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        if (!empty($tecnicoId)) {
            
            $tecnico = Tecnico::find($tecnicoId);

            $tecnico->update([
                'nombre' => $request->nombre,
                'numer_de_documento' => $request->numer_de_documento,
            ]);
            session()->flash('message', __('Actualización éxitosa') );
            return response()->json(['redirect' => route('company.technicals.index')]);

        } else {

            $tecnico = Tecnico::create([
                'nombre' => $request->nombre,
                'numer_de_documento' => $request->numer_de_documento,
            ]);

            session()->flash('message', __('Registro éxitoso') );
            return response()->json(['redirect' => route('company.technicals.index')]);
        }
    }

    public function edit($id) {
        $tecnico = Tecnico::findOrFail($id);
        return response()->json( ['tecnico' => $tecnico]);
    }

    public function destroy($id) {

        $tecnico = Tecnico::findOrFail($id);

        $tecnico->delete();
        return redirect()->route('company.technicals.index');
    }


}
