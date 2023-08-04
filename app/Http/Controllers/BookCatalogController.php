<?php

namespace App\Http\Controllers;

use App\Models\BookCatalog; // Importacion del Modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Importacion de validaciones

class BookCatalogController extends Controller
{
    /**
     * Lista todos los libros
     */
    public function index()
    {
       return response()->json(BookCatalog::all(), 200);
    }

    /**
     * Guarda un libro
     */
    public function store(Request $request)
    {

        // Validaciones
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'bookgenre' => 'required',
            'date' => 'required|date',
        ]);

        // Si hay errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        $bookCatalog = BookCatalog::create($request->all());

        // Retorna un JSON
        return response()->json($bookCatalog , 201);
    }

    /**
     * Muestra un libro segun el id
     */
    public function show($id)
    {
        // Busca el id en la base de datos
        $bookCatalog = BookCatalog::find($id);

        // Si no existe
        if (is_null($bookCatalog))  {
            return response()->json(['message' => 'No se ha encontrado el catalogo de libro'] , 404);
        }

        return response()->json($bookCatalog, 200);
    }

    /**
     * Actualiza un libro segun el id y los datos enviados
     */
    public function update(Request $request, $id)
    {

        // Validaciones
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'author' => 'required',
            'bookgenre' => 'required',
            'date' => 'required|date',
        ]);

        // Busca el id en la base de datos
        $bookCatalog = BookCatalog::find($id);


        // Si hay errores
        if ($validator->fails()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Si no existe
        else if (is_null($bookCatalog)) {
            return response()->json(['message' => 'No se ha encontrado el catalogo de libro'] , 404);
        }

        $bookCatalog->update($request->all());

        // Retorna un JSON
        return response()->json($bookCatalog, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request , $id)
    {

        // Busca el id en la base de datos
        $bookCatalog = BookCatalog::find($id);

        // Si no existe
        if (is_null($bookCatalog))  {
            return response()->json(['message' => 'No se ha encontrado el catalogo de libro'] , 404);
        }

        $bookCatalog->delete();

        // Retorna un JSON
        return response()->json(null , 204);
    }
}
