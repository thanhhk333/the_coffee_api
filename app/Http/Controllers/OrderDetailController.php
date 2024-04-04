<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;
use App\Models\Product;

class OrderDetailController extends Controller
{
    public function index($id = null)
    {
        try {
            if ($id) {
                $orderDetail = OrderDetail::find($id);
                if ($orderDetail) {
                    $orderDetail->load('items');
                    return response()->json($orderDetail);
                } else {
                    return response()->json(['error' => 'Order detail not found'], 404);
                }
            } else {
                $orderDetails = OrderDetail::all();
                foreach ($orderDetails as $orderDetail) {
                    $orderDetail->load('items');
                }
                return response()->json($orderDetails);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $userId = $request->input('user_id');
            if (!$userId) {
                return response()->json(['error' => 'User ID is required'], 400);
            }

            $orderDetail = new OrderDetail;
            $orderDetail->fill($request->all());
            $totalAmount = 0;
            foreach ($request->input('items') as $item) {
                $product = Product::find($item['id']);
                if ($product) {
                    $totalAmount += $item['quantity'] * $product->price;
                }
            }

            $orderDetail->total = $totalAmount;
            $orderDetail->status = 'pending';
            $orderDetail->user_id = $userId;
            $orderDetail->save();

            return response()->json([
                'message' => 'Successfully created order detail',
                'data' => $orderDetail
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $orderDetail = OrderDetail::find($id);
            if ($orderDetail) {
                if ($request->has('status')) {
                    $orderDetail->status = $request->input('status');
                    $orderDetail->save();

                    return response()->json([
                        'message' => 'Successfully updated order detail status',
                        'data' => $orderDetail
                    ]);
                } else {
                    return response()->json(['error' => 'No status provided'], 400);
                }
            } else {
                return response()->json(['error' => 'Order detail not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $orderDetail = OrderDetail::find($id);
            if ($orderDetail) {
                $orderDetail->delete();

                return response()->json([
                    'message' => 'Successfully deleted order detail'
                ]);
            } else {
                return response()->json(['error' => 'Order detail not found'], 404);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
