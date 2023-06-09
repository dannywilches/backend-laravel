<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Hoteles;

class HotelesController extends Controller
{
    /**
     * Funcion para retornar todos los hoteles e incluidas los tipos de habitacion
     */
    public function index()
    {
        $hoteles = Hoteles::with(['getHabitaciones'])->get();
        return response()->json([
            'hoteles' => $hoteles,
        ], 200);
    }

    /**
     * Funcion para crear un nuevo hotel
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required|min:2|max:30|unique:App\Models\Hoteles,nit',
            'num_habs' => 'required|min:1',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errores' => $request->num_habs,
                'status' => 204,
            ], 204);
        }

        $hotel = new Hoteles;
        $hotel->nombre = $request->nombre;
        $hotel->direccion = $request->direccion;
        $hotel->ciudad = $request->ciudad;
        $hotel->nit = $request->nit;
        $hotel->num_habs = $request->num_habs;

        $hotel->save();

        return response()->json([
            'hotel' => $hotel,
            'status' => 201,
        ], 201);
    }

    /**
     * Funcion para retornar la información de un hotel en especifico
     */
    public function show(string $id)
    {
        $hoteles = Hoteles::with(['getHabitaciones'])->find($id);
        return response()->json([
            'hoteles' => $hoteles,
        ], 200);
    }

    /**
     * Funcion para actualizar un hotel
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'nombre' => 'required',
            'direccion' => 'required',
            'ciudad' => 'required',
            'nit' => 'required|min:2|max:30|unique:App\Models\Hoteles,nit',
            'num_habs' => 'required|min:1',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errores' => $validate,
                'status' => 204,
            ], 204);
        }

        $hotel = Hoteles::find($id);

        if (!$hotel) {
            return response()->json([
                'mensaje' => 'El hotel para actualizar no existe',
                'status' => 204,
            ], 204);
        }

        $hotel->nombre = $request->nombre;
        $hotel->direccion = $request->direccion;
        $hotel->ciudad = $request->ciudad;
        $hotel->nit = $request->nit;
        $hotel->num_habs = $request->num_habs;

        $hotel->save();

        return response()->json([
            'hotel' => $hotel,
            'status' => 201,
        ], 201);
    }

    /**
     * Funcion para eliminar un hotel
     */
    public function destroy(string $id)
    {
        $hotel = Hoteles::find($id);
        if (!$hotel) {
            return response()->json([
                'mensaje' => 'El hotel a eliminar no existe',
                'status' => 204,
            ], 404);
        }

        $hotel->delete();
        return response()->json([
            'mensaje' => 'El hotel fue eliminado',
            'status' => 204,
        ], 204);
    }
}
