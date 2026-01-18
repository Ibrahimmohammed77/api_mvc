<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\ApiResponse;
use App\Models\Product;

class ProductApiController extends Controller
{
    private Product $productModel;

    public function __construct()
    {
        AuthApiController::requireAuth(); //  حماية JWT
        $this->productModel = $this->model('Product');
    }

    /**
     * GET /api/products
     */
    public function index(): void
    {
        ApiResponse::success(
            $this->productModel->all(),
            'قائمة المنتجات'
        );
    }

    /**
     * GET /api/products/{id}
     */
    public function show($id): void
    {
        $product = $this->productModel->find((int)$id);

        if (!$product) {
            ApiResponse::error('المنتج غير موجود', 404);
        }

        ApiResponse::success($product);
    }

    /**
     * POST /api/products
     */
    public function store(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (
            empty($data['name']) ||
            !isset($data['price']) ||
            !isset($data['quantity'])
        ) {
            ApiResponse::error('البيانات غير مكتملة', 422);
        }

        $this->productModel->create($data);

        ApiResponse::success(null, 'تم إنشاء المنتج', 201);
    }

    /**
     * PUT /api/products/{id}
     */
    public function update($id): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$this->productModel->find((int)$id)) {
            ApiResponse::error('المنتج غير موجود', 404);
        }

        $this->productModel->update((int)$id, $data);

        ApiResponse::success(null, 'تم تحديث المنتج');
    }

    /**
     * DELETE /api/products/{id}
     */
    public function destroy($id): void
    {
        if (!$this->productModel->find((int)$id)) {
            ApiResponse::error('المنتج غير موجود', 404);
        }

        $this->productModel->delete((int)$id);

        ApiResponse::success(null, 'تم حذف المنتج');
    }
}
