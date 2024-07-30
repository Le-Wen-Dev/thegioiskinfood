<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Products;

class ApiProductController extends Controller
{
    protected $pro;
    protected $categories;

    public function __construct()
    {
        $this->pro = new Products();
    }
    public function index()
    {
        $product = Products::all();
        return response()->json(
            [
                "status" => 200,
                "message" => "Get Product success !",
                "data" => $product
            ]
        );
    }
    public function productsSale()
    {

        $products = Products::select('id', 'name', 'description', 'img', 'price', 'sold', 'view')
            ->where('sold', '>=', 30)
            ->orderBy('sold', 'desc')
            ->paginate(5);

        return response()->json([
            'status' => 200,
            'message' => 'load success',
            'data' => $products
        ]);
    }
    public function store(Request $request)
    {
        // Validate form input
        $validateData = $request->all();

        // Check if the main image was uploaded
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $validateData['img'] = $imageName;
        } else {
            return response()->json([
                'status' => 422,
                'errors' => ['Image is required']
            ], 422);
        }

        // Check if gallery images were uploaded
        if ($request->hasFile('gallery')) {
            $imgData = [];

            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('img'), $name);
                $imgData[] = $name;
            }

            // Save gallery image data to the database
            $validateData['gallery'] = json_encode($imgData);
        } else {
            return response()->json(['error' => 'Gallery images not uploaded'], 400);
        }

        // Create the product
        $product = Products::create($validateData);
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Product created successfully',
                'data' => $product // Optionally return the created product data
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to create product'
            ], 500);
        }
    }
    public function showoneproduct(Request $request, $id)
    {
        $product = Products::find($id);
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'looke one record !',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Not found Record!',
                'data' => null
            ]);
        }
    }
    public function editproduct(Request $request, $id)
    {
        // Validate form input
        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Check if the main image was uploaded
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $validateData['img'] = $imageName;
        } else {
            return response()->json([
                'status' => 422,
                'errors' => ['Image is required']
            ], 422);
        }

        // Check if gallery images were uploaded
        if ($request->hasFile('gallery')) {
            $imgData = [];

            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('img'), $name);
                $imgData[] = $name;
            }

            // Save gallery image data to the database
            $validateData['gallery'] = json_encode($imgData);
        } else {
            return response()->json([
                'status' => 422,
                'errors' => ['Gallery images are required']
            ], 422);
        }

        // Find the product by ID
        $product = Products::find($id);

        // Check if product exists
        if ($product) {
            // Update the product
            $product->update($validateData);

            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully',
                'data' => $product
            ], 200);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product not found'
            ], 404);
        }
    }

    public function deleteproduct(Request $request, $id)
    {
        $product = Products::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'deleted success product!',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'not found recored product need delete!'
            ], 404);
        }
    }
    public function productbest()
    {
        $product = Products::orderBy('besseller', 1)->get();
        if ($product) {

            return response()->json([
                'status' => 200,
                'message' => 'load product bestseller success!',
                'data' => []
            ], 200);
        } else {
            return response()->json([
                'status' => '404',
                'message' => 'not found product!'
            ], 404);
        }
    }
}