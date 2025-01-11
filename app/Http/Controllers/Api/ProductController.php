<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Repositories\Product\ProductInterface;

class ProductController extends Controller
{

    use ApiResponse;

    private $productRepository;

    public function __construct(ProductInterface $productRepository){
        $this->productRepository = $productRepository;
    }

    public function allProducts()
    {
        $data = $this->productRepository->all();
        if(!$data){
            return $this->errorResponse('Products not found', 404);
        }else{
            return $this->successResponse(ProductResource::collection($data), 'Products retrieved successfully');
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page');
        $data = $this->productRepository->allPages($perPage);
        if(!$data){
            return $this->errorResponse('Product not found', 202);
        }else{
            return $this->successResponse(ProductResource::collection($data), 'Products retrieved successfully');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->productRepository->store($request);
        if(!$data){
            return $this->errorResponse('Product not created', 202);
        }else{
            return $this->successResponse(new ProductResource($data), 'Product created successfully');
        }
    }

    public function show(string $id)
    {
        $data = $this->productRepository->show($id);

        if (!$data) {
            return $this->errorResponse('The requested resource was not found.', 404);
        }

        return $this->successResponse(new ProductResource($data), 'Product retrieved successfully');

    }

    public function update(Request $request, string $id)
    {


        try {
            $data = $this->productRepository->update($request, $id);
            return $this->successResponse(new ProductResource($data), 'Product updated successfully');
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
            $data = $this->productRepository->delete($id);
            return $this->successResponse(new ProductResource($data), 'Product deleted successfully');
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
            $data = $this->productRepository->status($id);
            return $this->successResponse(new ProductResource($data), 'Product status changed successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}
