<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Form;
use App\Models\JsonSchema;
use App\Http\Requests\StoreFormRequest;
use App\Http\Resources\FormResource;
use App\Http\Resources\FormCollection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    /**
     * Display a listing of forms
     * 
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        // Paginate with eager loading to prevent N+1 queries
        $forms = Form::with('jsonSchema')
            ->latest()
            ->paginate(15);
        
        return response()->json([
            'success' => true,
            'data' => FormResource::collection($forms),
            'meta' => [
                'total' => $forms->total(),
                'per_page' => $forms->perPage(),
                'current_page' => $forms->currentPage(),
                'last_page' => $forms->lastPage(),
            ],
            'message' => 'Forms retrieved successfully'
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created form
     * 
     * @param StoreFormRequest $request
     * @param int $templateId
     * @return JsonResponse
     */
    public function store(StoreFormRequest $request, int $templateId): JsonResponse
    {
        try {
            // Validation is already handled by StoreFormRequest
            $template = JsonSchema::findOrFail($templateId);
            
            // Create form with validated data
            $form = Form::create([
                'json_schema_id' => $templateId,
                'data' => $request->validated()['data']
            ]);
            
            return response()->json([
                'success' => true,
                'data' => new FormResource($form),
                'message' => 'Form created successfully'
            ], Response::HTTP_CREATED);
            
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found',
                'error' => 'The specified template does not exist'
            ], Response::HTTP_NOT_FOUND);
            
        } catch (\Exception $e) {
            // Log error for debugging
            Log::error('Form creation failed: ' . $e->getMessage(), [
                'template_id' => $templateId,
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create form',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal server error'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}

