<?php

namespace App\Http\Middleware;

use App\Models\Commune;
use App\Models\Region;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;

class ValidateEntryDataCustomer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($request->getMethod() === 'POST') {
            $validateFields = Validator::make($request->all(), [
                'dni' => 'required|numeric',
                'id_reg' => 'required|numeric',
                'id_com' => 'required|numeric',
                'email' => 'required|email',
                'name' => 'required|string',
                'last_name' => 'required|string',
                'address' => 'nullable|string',
            ]);

            $findRegion = Region::where('id_reg', $request->get('id_reg'))->first();
            $findCommune = Commune::where([['id_com', $request->get('id_com')], ['id_reg', $request->get('id_reg')]])->first();

            if ($validateFields->fails() || $findRegion || $findCommune) {
                return response()->json(['message' => 'Error in data to create resource', 'success' => false]);
            }
        }


        return $response;
    }
}
