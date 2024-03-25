<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Cache;
class EntityController extends Controller
{
    public function listEntity(Request $request)
{
    $cacheKey = 'customer_list_' . md5(serialize($request->all()));

    // Check if the data is already cached
    if (Cache::has($cacheKey)) {
        // Retrieve data from cache
        $customers = Cache::get($cacheKey);
    } else {
        if ($request->entity_type == "customer") {
            // Check if pagination is requested
            $customers=Customer::orderBy('created_at', 'DESC');
            
            if($request->search)
            {
                
                $customers = $customers->where('customer_name', 'like', '%' . $request->search . '%');
            }
            elseif($request->default_selected)
            {
                $customers = $customers->where('id','=', $request->default_selected);

            }
            if ($request->has('paginate') && $request->paginate == 1) {
                // Set the default number of items per page
                $perPage = $request->has('per_page') ? $request->per_page : 20;
                // Fetch customers with pagination
                
                
                $customers=$customers->paginate($perPage);
                
            } else {
                // Fetch all customers without pagination
                $customers = $customers->get(['id', 'customer_name']);
            }
            // Cache the data
            Cache::put($cacheKey, $customers, now()->addMinutes(60)); // Cache for 60 minutes
        } else {
            // Return an empty response for non-customer entities
            $customers = [];
        }
    }

    return response()->json($customers);
}
}
