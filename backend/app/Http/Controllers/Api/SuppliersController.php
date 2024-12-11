<?php

namespace App\Http\Controllers\Api;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Http\Controllers\Api\BaseController;

 /**
     * @group Suppliers Management.
    */
 
class SuppliersController extends BaseController
{
    /**
     * All Suppliers.
     */
    public function index(): JsonResponse
    {
        $suppliers = Supplier::all();
        
        return $this->sendResponse(["Suppliers"=> SupplierResource::collection($suppliers)], 'Supplier Retrived Successfully');
    }

    /**
     * Store Supplier.
     * @bodyParam supplier sting The name of the Supplier.
     * @bodyParam street_address string The street address of the Supplier.
     * @bodyParam area string The area of the Supplier.
     * @bodyParam city string The city of the Supplier.
     * @bodyParam state string The state of the Supplier.
     * @bodyParam pincode string The pincode of the Supplier.
     * @bodyParam country string The country of the Supplier.
     * @bodyParam gstin string The gstin of the Supplier.
     * @bodyParam contact_no string The contact number of the Supplier.
     * @bodyParam department string The department of the Supplier.
     * @bodyParam designation string The designation of the Supplier.
     * @bodyParam mobile_1 string The mobile 1 of the Supplier.
     * @bodyParam mobile_2 string The mobile 2 of the Supplier.
     * @bodyParam email string The email of the Supplier.
     */
    public function store(Request $request): JsonResponse
    {
        $suppliers = new Supplier();
        $suppliers->supplier = $request->input("supplier");
        $suppliers->street_address = $request->input("streetAddress");
        $suppliers->area = $request->input("area");
        $suppliers->city = $request->input("city");
        $suppliers->state = $request->input("state");
        $suppliers->pincode = $request->input("pincode");
        $suppliers->country = $request->input("country");
        $suppliers->gstin = $request->input("gstin");
        $suppliers->contact_no = $request->input("contactNo");
        $suppliers->department = $request->input("department");
        $suppliers->designation = $request->input("designation");
        $suppliers->mobile_1 = $request->input("mobile1");
        $suppliers->mobile_2 = $request->input("mobile2");
        $suppliers->email = $request->input("email"); 
        $suppliers->save();

        return $this->sendResponse(["Suppliers"=> new SupplierResource($suppliers)], 'Supplier Stored Successfully');

    }

    /**
     * Show Suppliers.
     */
    public function show(string $id): JsonResponse
    {
        $suppliers = Supplier::find($id);
        if(!$suppliers){
            return $this->sendError("Suppliers not found", ['error'=>'Suppliers not found']);
        }
        
        return $this->sendResponse(["Supplier"=> new SupplierResource($suppliers)], 'Supplier retrived Successfully');
    }

    /**
     * Update Suppliers.   
     * @bodyParam supplier sting The name of the Supplier.
     * @bodyParam street_address string The street address of the Supplier.
     * @bodyParam area string The area of the Supplier.
     * @bodyParam city string The city of the Supplier.
     * @bodyParam state string The state of the Supplier.
     * @bodyParam pincode string The pincode of the Supplier.
     * @bodyParam country string The country of the Supplier.
     * @bodyParam gstin string The gstin of the Supplier.
     * @bodyParam contact_no string The contact number of the Supplier.
     * @bodyParam department string The department of the Supplier.
     * @bodyParam designation string The designation of the Supplier.
     * @bodyParam mobile_1 string The mobile 1 of the Supplier.
     * @bodyParam mobile_2 string The mobile 2 of the Supplier.
     * @bodyParam email string The email of the Supplier.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        // Find the existing supplier
        $suppliers = Supplier::find($id);
    
        if (!$suppliers) {
            return $this->sendError("Supplier not found", ['error' => 'Supplier not found']);
        }
    
        // Update the supplier properties
        $suppliers->supplier = $request->input("supplier");
        $suppliers->street_address = $request->input("streetAddress");
        $suppliers->area = $request->input("area");
        $suppliers->city = $request->input("city");
        $suppliers->state = $request->input("state");
        $suppliers->pincode = $request->input("pincode");
        $suppliers->country = $request->input("country");
        $suppliers->gstin = $request->input("gstin");
        $suppliers->contact_no = $request->input("contactNo");
        $suppliers->department = $request->input("department");
        $suppliers->designation = $request->input("designation");
        $suppliers->mobile_1 = $request->input("mobile1");
        $suppliers->mobile_2 = $request->input("mobile2");
        $suppliers->email = $request->input("email");
    
        // Save the updated supplier
        $suppliers->save();
    
        return $this->sendResponse(["Supplier" => new SupplierResource($suppliers)], 'Supplier Updated Successfully');
    }
    
    /**
     * Destroy Suppliers.
     */
    public function destroy(string $id): JsonResponse
    {
        $suppliers = Supplier::find($id);
        if(!$suppliers){
            return $this->sendError("Supplier not found", ['error'=>'Supplier not found']);
        }
        $suppliers->delete();
        return $this->sendResponse([], 'Supplier Deleted Successfully');

    }
}