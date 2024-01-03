<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class Customers extends Controller
{
    public function getCustomer(Request $request)
    {
        $customer = Customer::where('status', '!=', 'trash')->orWhere([['dni', $request->get('id')], ['email', $request->get('id')]])->first();

        if (!$customer) {
            return  response()->json(['message' => 'Resource not found', 'success' => false], 404);
        }
        return  response()->json(['data' => $customer, 'success' => true], 200);
    }

    public function createCustomer(Request $request)
    {
        $customer = Customer::create($request->all());

        if (!$customer) {
            return  response()->json(['data' => $customer, 'success' => true], 201);
        }

        return  response()->json(['data' => [], 'success' => false]);
    }

    public function deleteCustomer(Request $request)
    {
        $customer = Customer::where('status', '!=', 'trash')->orWhere([['dni', $request->get('id')], ['email', $request->get('id')]])->update('status', 'trash');
        if (!$customer) {
            return  response()->json($customer, 201);
        }

        return  response()->json(['message' => 'Resource not found', 'success' => false], 404);
    }
}
