<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return response(Product::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $product = new Product();
        $product->name = $request['name'];
        $product->quantity = $request['quantity'];
        $product->is_completed = 0;
        if ($product->save()) {
            return response($product, 200);
        } else {
            return response()->json([
                        "message" => "An error occurred"
                            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $product = Product::find($id);
        if ($product instanceof Product) {
            return response($product, 200);
        } else {
            return response()->json([
                        "message" => "Product not found"
                            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $product = Product::find($id);
        if ($product instanceof Product) {
            $product->name = is_null($request->name) ? $product->name : $request->name;
            $product->quantity = is_null($request->quantity) ? $product->quantity : $request->quantity;
            $product->is_completed = is_null($request->is_completed) ? $product->is_completed : $request->is_completed;
            $product->save();
            return response()->json([
                        "message" => "Product updated successfully"
                            ], 200);
        } else {
            return response()->json([
                        "message" => "Product not found"
                            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $product = Product::find($id);
        if ($product instanceof Product) {
            $product->delete();
            return response()->json([
                        "message" => "Product deleted successfully"
                            ], 202);
        } else {
            return response()->json([
                        "message" => "Product not found"
                            ], 404);
        }
    }

}
