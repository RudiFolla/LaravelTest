<?php

namespace App\Http\Controllers\Api;

use App\Models\Customer;
use App\Enum\UserRoleEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Http\Requests\Customer\StoreCustomerRequest;
use App\Http\Requests\Customer\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request)
    {
        if($request->user()->hasPermissionTo('create customers'))
        {
            $customer = Customer::create($request->validated());
            return CustomerResource::make($customer);  
        }
        return response('You don\'t have the permission for this action',403);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return CustomerResource::make($customer);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        if($request->user()->hasPermissionTo('update customers'))
        {
            $customer->update($request->validated());
            return CustomerResource::make($customer);
        }
        return response('You don\'t have the permission for this action',403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        return response('functionality not implemented',501);
    }
}
