<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Customer::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uuid =  Str::uuid();
        $validatedRequest = request()->validate([
            'name' => 'string|required',
            'phone' => 'string|required',
            'address' => 'string|required',
        ]);
        $validatedRequest['uuid'] = $uuid;
        try {
            $department = Customer::create($validatedRequest);
            return response()->json($department, Response::HTTP_OK);
        } catch (QueryException $th) {
            $response = [
                'message' => 'failed' . $th
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
