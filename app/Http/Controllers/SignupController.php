<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Customer;
use JWTFactory;
use JWTAuth;
//use Illuminate\Http\Response;

class SignupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        //return response(array("data"=> "post welcome"), 400);
        //return response()->json([["pel"=>"ksl", "jj"=>'kdjl']]);
        $firstName = $request->firstName;
        $lastName = $request->lastName;
        $email = $request->email;
        $phone = $request->phone;
        $password = $request->password;

        if (
            empty($firstName) ||
            empty($lastName) ||
            empty($email) ||
            empty($phone) ||
            empty($password)
            ) {

                return response()->json(["msg"=>"$firstName $lastName $email $phone $password"], 400);
            }

            $customer = new Customer();
            $customer->first_name = $firstName;
            $customer->last_name = $lastName;
            $customer->email = $email;
            $customer->phone = $phone;
            $customer->password = Hash::make($password);
            $customer->save();

            $payload = JWTFactory::make(["email"=>$customer->email, "password"=>$customer->password]);
    

            $token = JWTAuth::fromUser($payload);
            
            return ["customer"=>$customer, "token"=>$token];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
