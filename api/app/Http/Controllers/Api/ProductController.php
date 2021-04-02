<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Product;
use Tymon\JWTAuth\Facades\JWTAuth;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class ProductController extends Controller
{
    protected $user;

    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

        return response()->json($products);
    }

    /**
     * Register a new Product.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'description' => 'required|string|max:500',
            'name' => 'required|string|max:255',
            'price' => 'required|string|max:255',
        ]);

        $user = Product::create(array_merge(
            $validator->validated()
        ));

        return response()->json([
            'message' => 'Successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Update a Product.
     */
    public function update(Request $request, $id)
    {
        if (Product::where('id', $id)->exists())
        {
            $product = Product::find($id);
            $product->description = is_null($request->description) ? $request->description : $request->description;
            $product->name = is_null($request->name) ? $request->name : $request->name;
            $product->save();
        }

//        $product->name = $request->name;
//        $product->price = $request->price;
//        $product->save();
//        $product->fill($new_product);

        return response()->json([
            'message' => 'product altered'
        ], 202);
    }

    /**
     * Remove product into database
     **/
    public function destroy($id)
    {
        if (Product::where('id', $id)->exists()) {
            $user = Product::find($id);
            $user->delete();
            auth('api')->logout();

            return response()->json([
                'message' => 'product deleted'
            ], 202);
        } else {
            return response()->json([
                'message' => 'product not found'
            ], 404);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}

