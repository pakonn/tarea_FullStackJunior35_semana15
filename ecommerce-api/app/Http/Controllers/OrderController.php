<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Brick\Math\BigInteger;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function listOrders(String $id)
    {
        try{
            //$orders= Order::all();
            //$orders = Order::where('user_id', $id)->get();
            
            $orders = Order::with([
                'user',
                'OrdersItem'
            ])
            ->where('user_id', $id)
            ->get();

            return response()->json(
                [
                    'data'=>$orders
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
                'nombre_cliente'=>'required|string',
                'direccion_cliente'=>'required|string',
                'telefono_cliente'=>'required|numeric',
                'email_cliente'=>'required|string',
                'order_item'              => 'required|array',
                'order_item.*.product_id' => 'required|numeric',
                'order_item.*.cantidad'   => 'required|numeric'                
            ]);
            $order= Order::create([
                'nombre_cliente'=> $request->nombre_cliente,
                'direccion_cliente'=> $request->direccion_cliente,
                'telefono_cliente'=> $request->telefono_cliente,
                'email_cliente'=> $request->email_cliente,
                'user_id'=> $request->user()->id
            ]);
            $order->OrdersItem()->createMany($request->order_item);

            //$order = Order::with('user')->find($order->id);
            $order = Order::with([
                'user',
                'OrdersItem'
            ])->find($order->id);
            return response()->json(
                [
                    'message'=>'Order created successfully',
                    'data'=>$order
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
    public function update_head(Request $request, string $id)
    {
        try{
            $order= Order::findOrFail($id);
            $request->validate([
                'nombre_cliente'=>'required|string',
                'direccion_cliente'=>'required|string',
                'telefono_cliente'=>'required|numeric',
                'email_cliente'=>'required|string'
            ]);
            $order->update($request->all());
            return response()->json(
                [
                    'message'=>'Order update successfully',
                    'data'=>$order
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
    public function destroy_head(string $id)
    {
        try{
            $order= Order::findOrFail($id);
            $order->delete();
            return response()->json(
                [
                    'message'=>'Order delited successfully'
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
    public function restore_head(Request $request, string $id)
    {
        try{
            $order= Order::onlyTrashed()->findOrFail($id);
            $order->restore();
            return response()->json(
                [
                    'message'=>'Order restored successfully'
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
