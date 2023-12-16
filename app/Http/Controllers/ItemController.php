<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();

        $response = ['status' => 'Success', 'statusCode' => 200, 'data' => $items, 'message' => ($items->count() === 0) ? 'No Records Found' : $items->count() . ' Records Found successfully!'];
        
        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'category' => 'required|string',
            'name' => 'required|string',
            'description' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            $response = ['status' => 'Failed', 'statusCode' => 404, 'data' => $validator->errors()->messages(), 'message' => 'Error'];
        } else {
            $save = Item::create($data);

            $response = ['status' => 'Success', 'statusCode' => 200, 'data' => $save->toArray(), 'message' => 'Record inserted successfully!'];
        }

        return response()->json($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        //
    }
}
