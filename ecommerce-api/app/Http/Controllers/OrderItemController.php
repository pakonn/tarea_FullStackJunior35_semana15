<?php

namespace App\Http\Controllers;

use App\Models\order_item;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    public function update_line(Request $request, string $id)
    {
        try{
            $order_item= OrderItem::findOrFail($id);
            $request->validate([
                'cantidad'=>'required|numeric',
                'product_id'=>'required|numeric'
            ]);
            $order_item->update($request->all());
            return response()->json(
                [
                    'message'=>'Order Item updated successfully',
                    'data'=>$order_item
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
    public function destroy_line(string $id)
    {
        try{
            $order_item= OrderItem::findOrFail($id);
            $order_item->delete();
            return response()->json(
                [
                    'message'=>'Order Item delited successfully'
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
    public function restore_line(Request $request, string $id)
    {
        try{
            $order_item= OrderItem::onlyTrashed()->findOrFail($id);
            $order_item->restore();
            return response()->json(
                [
                    'message'=>'Order Item restored successfully'
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
