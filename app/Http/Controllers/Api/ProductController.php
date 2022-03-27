<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Repository\ProductRepositoryInterface;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    private ProductRepositoryInterface $productRepository;


    public function __construct(ProductRepositoryInterface $productRepository) {
        $this->productRepository = $productRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function index(): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->productRepository->allPaginated(config('settings.pagination_limit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return JsonResponse
     */
    public function store(StoreUpdateProductRequest $request): JsonResponse
    {
        $data = $this->productRepository->create($request->validated());
        if ($data)
            return response()->json(
                $data
            , 200);
        else
            return response()->json([], 501);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        $data = $this->productRepository->find($id);
        if ($data)
            return response()->json(
                $data
            , 200);
        else
            return response()->json([], 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  int $id
     * @return JsonResponse
     */
    public function update(StoreUpdateProductRequest $request, int $id): JsonResponse
    {
        $data = $this->productRepository->find($id);
        if ($data)
            return response()->json(
                $this->productRepository->update($data, $request->validated())
            , 200);
        else
            return response()->json([], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return JsonResponse
     */
    public function destroy(int $id): JsonResponse
    {
        $data = $this->productRepository->find($id);
        if ($data)
            return response()->json([
                'is_delete' => $data->delete()
            ], 200);
        else
            return response()->json([], 404);
    }
}
