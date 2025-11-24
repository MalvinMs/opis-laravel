<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\JsonSchema;
use Illuminate\Http\Request;

class JSONSchemaController extends Controller
{
    public function index(Request $request){
        $data = JsonSchema::all();
        return response()->json($data);
    }

    public function store(Request $request){
        try {
            // Validasi input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'schema' => 'required',
            ]);

            // Create data
            $data = JsonSchema::create($validated);

            // Return response dengan status code 201 (Created)
            return response()->json([
                'success' => true,
                'message' => 'JSON Schema created successfully',
                'data' => $data
            ], 201);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation error dengan status code 422
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            // Return error untuk exception lainnya
            return response()->json([
                'success' => false,
                'message' => 'Failed to create JSON Schema',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
