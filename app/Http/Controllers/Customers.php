<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class Customers extends Controller
{
    private function buildGetQuery(Request $request)
    {
        return Customer::select('name', 'last_name', 'address')
            ->with('region', function ($query) {
                $query->select('description')->with('commune');
            })
            ->where(function ($query) use ($request) {
                $query->orWhere('dni', '=', $request->id)
                    ->orWhere('email', '=', $request->id);
            });
    }

    public function getCustomer(Request $request)
    {
        $customer = $this->buildGetQuery($request)->where('status', 'A')->first();

        if (!$customer) {
            return  response()->json([
                'message' => 'Resource not found',
                'success' => false
            ], 404);
        }
        return  response()->json(['data' => $customer, 'success' => true], 200);
    }

    public function createCustomer(Request $request)
    {
        $customer = Customer::create($request->all());

        if (!$customer) {
            return  response()->json([
                'data' => $customer,
                'success' => true
            ], 201);
        }

        return  response()->json([
            'message' => 'Error to create resource',
            'success' => false
        ], 400);
    }

    public function deleteCustomer(Request $request)
    {
        $customer = $this->buildGetQuery($request)
            ->where('status', '!=', 'trash')
            ->update(['status' => 'trash']);

        if (!$customer) {
            return  response()->json([
                'message' => 'Resource not found',
                'success' => false
            ], 404);
        }
        return  response()->json([
            'message' => 'Resource deleted successfully',
            'success' => true
        ], 201);
    }
}
