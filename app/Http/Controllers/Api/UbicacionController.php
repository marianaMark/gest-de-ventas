<?php

namespace App\Http\Controllers\Api;

use App\Models\Ubicacion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UbicacionController extends Controller
{
    //mostrar todos los datos
    public function index()
    {
        $ubicacion = Ubicacion::all();
        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //ingresar datos
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'required|max:255',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }

        $ubicacion = Ubicacion::create([
            'nombre_ubicacion' => $request->nombre_ubicacion,
            'capacidad' => $request->capacidad,
            'descripcion' => $request->descripcion,
        ]);

        if (!$ubicacion) {
            $data = [
                'message' => 'Error al crear la Ubicacion',
                'status' => 500
            ];
            return response()->json($data, 500);
        }

        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 201
        ];

        return response()->json($data, 201);
    }
    //mostrar un determinado registro
    public function show($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //eliminar
    public function destroy($id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $ubicacion->delete();

        $data = [
            'message' => 'Ubicacion eliminada',
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar
    public function update(Request $request, $id)
    {
        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'required|max:255',
            'capacidad' => 'required|integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];

            return response()->json($data, 400);
        }
        $ubicacion->nombre_ubicacion = $request->nombre_ubicacion;
        $ubicacion->capacidad = $request->capacidad;
        $ubicacion->descripcion = $request->descripcion;

        $ubicacion->save();

        $data = [
            'message' => 'Ubicacion actualizada',
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];

        return response()->json($data, 200);
    }
    //actualizar un dato en especifico
    public function updatePartial(Request $request, $id)
    {

        $ubicacion = Ubicacion::find($id);

        if (!$ubicacion) {
            $data = [
                'message' => 'Ubicacion no encontrada',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validator = Validator::make($request->all(), [
            'nombre_ubicacion' => 'max:255',
            'capacidad' => 'integer',
            'descripcion' => 'nullable'
        ]);

        if ($validator->fails()) {
            $data = [
                'message' => 'Error en la validación de los datos',
                'errors' => $validator->errors(),
                'status' => 400
            ];
            return response()->json($data, 400);
        }

        if ($request->has('nombre_ubicacion')) {
            $ubicacion->nombre_ubicacion = $request->nombre_ubicacion;
        }

        if ($request->has('capacidad')) {
            $ubicacion->capacidad = $request->capacidad;
        }

        if ($request->has('descripcion')) {
            $ubicacion->descripcion = $request->descripcion;
        }

        $ubicacion->save();

        $data = [
            'message' => 'Ubicacion actualizada',
            'Ubicaciones' => $ubicacion,
            'status' => 200
        ];
        return response()->json($data, 200);
    }
}