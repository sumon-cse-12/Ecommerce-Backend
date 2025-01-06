<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\CategoryUpdateRequest;
use App\Repositories\Category\CategoryInterface;

class CategoryController extends Controller
{
    use ApiResponse;
    private $categoryRepository;

    public function __construct(CategoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function allCategories()
    {
        $data = $this->categoryRepository->all();
        if(!$data){
            return $this->errorResponse('Categories not found', 404);
        }else{
            return $this->successResponse(CategoryResource::collection($data), 'Categories retrieved successfully');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page');
        $data = $this->categoryRepository->allPages($perPage);
        if(!$data){
            return $this->errorResponse('Categories not found', 202);
        }else{
            return $this->successResponse(CategoryResource::collection($data), 'Categories retrieved successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        dd($request->all());
        $data = $this->categoryRepository->store($request);
        if(!$data){
            return $this->errorResponse('Category not created', 202);
        }else{
            return $this->successResponse(new CategoryResource($data), 'Category created successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = $this->categoryRepository->show($id);

        if (!$data) {
            return $this->errorResponse('The requested resource was not found.', 404);
        }

        return $this->successResponse(new CategoryResource($data), 'Category retrieved successfully');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryUpdateRequest $request, string $id)
    {


        try {
            $data = $this->categoryRepository->update($request, $id);
            return $this->successResponse(new CategoryResource($data), 'Category updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       try {
            $data = $this->categoryRepository->delete($id);
            return $this->successResponse(new CategoryResource($data), 'Category deleted successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

     /**
     * Change status the specified resource from storage.
     */
    public function status(string $id)
    {
        try {
            $data = $this->categoryRepository->status($id);
            return $this->successResponse(new CategoryResource($data), 'Category status changed successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
