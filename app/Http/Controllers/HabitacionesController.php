<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Habitaciones;

class HabitacionesController extends Controller
{
    /**
     * Funcion para retornar todos los habitaciones e incluidas los tipos de habitacion
     */
    public function index()
    {
        $habitaciones = Habitaciones::with(['getHotel'])->get();
        return response()->json([
            'habitaciones' => $habitaciones,
        ], 200);
    }

    /**
     * Funcion para crear un nuevo habitacion
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'id_hotel' => 'required',
            'num_habs' => 'required|min:1',
            'tipo_hab' => 'required',
            'acomodacion' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errores' => $request->num_habs,
                'status' => 204,
            ], 201);
        }

        $habitacion = new Habitaciones();
        $habitacion->id_hotel = $request->id_hotel;
        $habitacion->num_habs = $request->num_habs;
        $habitacion->tipo_hab = $request->tipo_hab;
        $habitacion->acomodacion = $request->acomodacion;

        $habitacion->save();

        return response()->json([
            'habitacion' => $habitacion,
            'status' => 201,
        ], 201);
    }

    /**
     * Funcion para retornar la información de un habitacion en especifico
     */
    public function show(string $id)
    {
        $habitaciones = Habitaciones::with(['getHabitaciones'])->find($id);
        return response()->json([
            'habitaciones' => $habitaciones,
        ], 200);
    }

    /**
     * Funcion para actualizar un habitacion
     */
    public function update(Request $request, string $id)
    {
        $validate = Validator::make($request->all(), [
            'id_hotel' => 'required',
            'num_habs' => 'required|min:1',
            'tipo_hab' => 'required',
            'acomodacion' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json([
                'errores' => $validate,
                'status' => 204,
            ], 201);
        }

        $habitacion = Habitaciones::find($id);

        if (!$habitacion) {
            return response()->json([
                'mensaje' => 'El habitacion para actualizar no existe',
            ], 404);
        }

        $habitacion->id_hotel = $request->id_hotel;
        $habitacion->num_habs = $request->num_habs;
        $habitacion->tipo_hab = $request->tipo_hab;
        $habitacion->acomodacion = $request->acomodacion;

        $habitacion->save();

        return response()->json([
            'habitacion' => $habitacion,
        ], 201);
    }

    /**
     * Funcion para eliminar un habitacion
     */
    public function destroy(string $id)
    {
        $habitacion = Habitaciones::find($id);
        if (!$habitacion) {
            return response()->json([
                'mensaje' => 'El habitacion a eliminar no existe',
            ], 404);
        }

        $habitacion->delete();
        return response()->json([
            'mensaje' => 'El habitacion fue eliminado',
        ], 200);
    }
}
