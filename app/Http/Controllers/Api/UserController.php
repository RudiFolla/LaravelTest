<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Enum\UserRoleEnum;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->validated());
        if($user->role == UserRoleEnum::DEV)
            $user->assignRole('dev');
        else if($user->role == UserRoleEnum::PM)
            $user->assignRole('pm');
        $token = $user->createToken('appToken')->plainTextToken;
        return $token;
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return UserResource::make($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        if($request->user()->role == UserRoleEnum::PM || $request->user()->id == $user->id)
        {
            $user->update($request->validated());
            return UserResource::make($user);
        } else
            return response('You don\'t have the permission for this action',400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
        return response('functionality not implemented',501);
    }
}
