<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomersController extends Controller
{
    private function buildGetQuery(Request $request)
    {
        return  DB::table('customers')
            ->join('regions', 'customers.id_reg', '=', 'regions.id_reg')
            ->join('communes', 'customers.id_reg', '=', 'communes.id_com')
            ->select('customers.name', 'customers.last_name', 'customers.address', 'regions.description as description_reg', 'communes.description as description_com')
            ->where(function ($query) use ($request) {
                $query->orWhere('customers.dni', '=', $request->id)
                    ->orWhere('customers.email', '=', $request->id);
            });
    }

    public function getCustomer(Request $request)
    {
        $customer = $this->buildGetQuery($request)->where('customers.status', 'A')->first();

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

        try {

            $customer = Customer::create([...$request->all(), 'date_reg' => \Carbon\Carbon::now()]);

            return  response()->json([
                'data' => $customer,
                'success' => true
            ], 201);
        } catch (\Exception $e) {
            if ($e->getCode() === '23000') {
                return  response()->json([
                    'message' => 'Resource already exists',
                    'success' => false
                ], 400);
            }
            return  response()->json([
                'message' => 'Error to create resource',
                'success' => false
            ], 400);
        }
    }

    public function deleteCustomer(Request $request)
    {
        $customer = $this->buildGetQuery($request)
            ->where('customers.status', '!=', 'trash')
            ->update(['customers.status' => 'trash']);

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
