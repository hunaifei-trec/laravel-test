<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductController extends Controller
{
    private $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function lists(Request $request)
    {
        $search = $request->input('Product');
        $searchName = null;
        if (!empty($search)) {
            $searchName = $search['name'];
        }
        $products = $this->productRepository->findAll($searchName);
        return view('product.lists', [
            'products' => $products,
        ]);
    }

    public function detail($productId)
    {
        $product = $this->productRepository->detail($productId);
        return view('product.detail', [
            'product' => $product
        ]);
    }

    public function create(Request $request)
    {
        $product = null;
        if ($request->isMethod('POST')) {
            $validator = \Validator::make($request->input(), [
                'Product.name' => 'required|unique:products,name',
                'Product.sku' => 'integer',
            ], [
                'unique' => ':attribute cannot be repeated',
                'required' => ':attribute is required',
                'integer' => ':attribute must be an integer',
            ], [
                'Product.name' => 'name',
                'Product.sku' => 'sku',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = $request->input('Product');
            $data['product_id'] = Uuid::uuid4();
            $data['created_by'] = Auth::user()->id;
            if ($request->hasFile('image')) {
                $imageUrl = $request->file('image')->store('images/product');
                $data['image_url'] = $imageUrl;
            }

            if ($this->productRepository->create($data)) {
                return redirect('product/lists')->with('success', 'Create Success');
            } else {
                return redirect()->back();
            }
        }

        return view('product.create', [
            'product' => $product
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'Product.name' => 'required|unique:products,name,'  .$id.',product_id',
                'Product.sku' => 'integer',
            ], [
                'required' => ':attribute is required',
                'unique' => ':attribute cannot be repeated',
                'integer' => ':attribute must be an integer',
            ], [
                'Product.name' => 'name',
                'Product.sku' => 'sku',
            ]);

            $data = $request->input('Product');
            $data['updated_by'] = Auth::user()->id;
            if ($request->hasFile('image')) {
                $imageUrl = $request->file('image')->store('images/product');
                $data['image_url'] = $imageUrl;
            }
            if ($this->productRepository->update($data, $id)) {
                return redirect('product/lists')->with('success', 'Update Success: ' . $id);
            }
        }

        $product = $this->productRepository->detail($id);
        return view('product.update', [
            'product' => $product
        ]);
    }

    public function delete($id)
    {
        if ($this->productRepository->delete($id)) {
            return redirect('product/lists')->with('success', 'Delete Success:' . $id);
        } else {
            return redirect('product/lists')->with('error', 'Delete Fail:' . $id);
        }
    }
}
