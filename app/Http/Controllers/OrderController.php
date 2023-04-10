<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Order::all()->load('order_items')->load('customer');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        DB::beginTransaction();
        $uuid =  Str::uuid();
        $date = Carbon::now();
        try {
            $validate = Validator::make($request->all(), [
            'customer_id' => 'string|required',
            'code' => 'string|required',
            'address' => 'string|required',
            'items' => 'array|required',
            //validate untuk entry
            'items.*.item_id' => 'string|required',
            'items.*.qty' => 'integer|required',
            'items.*.price' => 'numeric|required',
            'items.*.discount' => "numeric|required",
            'items.*.note' => "string|required",
            ]);
            if ($validate->fails()) {
                return response()->json($validate->errors(), Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $request['uuid'] = $uuid;
            $request['date'] = $date;
            $result = new Order($request->except('items'));
            $result->save();

            $entry = [];
            foreach ($request->items as $key => $value) {
                $item = new OrderItem($value);
                $item['uuid'] =  Str::uuid();
                $item['order_id'] = $result->id;
                $item['total'] = $value['price'] * $value['qty'] - $value['discount'];
                array_push($entry, $item);
            }
            $result->order_items()->saveMany($entry);
            $result->load('order_items');
            DB::commit();
            return response()->json($result, Response::HTTP_OK);
        } catch (QueryException $e) {
            DB::rollBack();
            $response = [
                'message' => 'failed' . $e
            ];
            return response()->json($response, Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
