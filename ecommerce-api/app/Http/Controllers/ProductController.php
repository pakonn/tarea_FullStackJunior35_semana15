<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        try{
            $products= product::all();
            return response()->json(
                [
                    'data'=>$products
                ]
            );
        }catch(\Exception $error){
            return response()->json(
                [
                    'message'=>$error->getMessage()
                ]
            );
        }
    }
    public function store(Request $request)
    {
        try{
            $request->validate([
                'tipo'=>'required|string',
                'nombre'=>'required|string',
                'precio'=>'required|numeric'
            ]);
            $product= Product::create([
                'tipo'=> $request->tipo,
                'nombre'=> $request->nombre,
                'precio'=> $request->precio,
                'user_id'=> $request->user()->id
            ]);
            return response()->json(
                [
                    'message'=>'Product created successfully',
                    'data'=>$product
                ],201
            );
        }catch(\Exception $error){
            return response()->json(
                [
                    'message'=>$error->getMessage()
                ]
            );
        }        
    }
    public function update(Request $request, string $id)
    {
        try{
            $product= Product::findOrFail($id);
            $request->validate([
                'tipo'=>'required|string',
                'nombre'=>'required|string',
                'precio'=>'required|numeric'
            ]);
            $product->update($request->all());
            return response()->json(
                [
                    'message'=>'Product update successfully',
                    'data'=>$product
                ]
            );            
        }catch(\Exception $error){
            return response()->json(
                [
                    'message'=>$error->getMessage()
                ]
            );
        }        
    }
    public function destroy(string $id)
    {
        try{
            $product= Product::findOrFail($id);
            $product->delete();
            return response()->json(
                [
                    'message'=>'Product delited successfully'
                ]
            );
        }catch(\Exception $error){
            return response()->json(
                [
                    'message'=>$error->getMessage()
                ]
            );
        }        
    }
    public function restore(Request $request, string $id)
    {
        try{
            $product= Product::onlyTrashed()->findOrFail($id);
            $product->restore();
            return response()->json(
                [
                    'message'=>'Product restored successfully'
                ]
            );
        }catch(\Exception $error){
            return response()->json(
                [
                    'message'=>$error->getMessage()
                ]
            );
        }        
    }    
}
