<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Order;

class OrdersController extends Controller
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

        if(isset($request->application_id)){

            // Find the Application
            if(\App\Application::where('id', $request->application_id)->exists()){

                // Create New Order
                Order::create([
                    'application_id' => $request->application_id,
                    'user_id' => $request->user()->id,
                ]);

                \Session::flash('alert-success', 'App successfully purchased !!!');
                return response()->json([
                    "success" => "OK: Order placed successfully"
                ], 200);

            } else {
                \Session::flash('alert-warning', 'An error ocurred, please try again !!!');
                return response()->json([
                    "error" => "Not Found: Application ID not found"
                ], 404);
            }
            
        }

        \Session::flash('alert-warning', 'An error ocurred, please try again !!!');
        return response()->json([
            "error" => "Not Found: No Application ID was found in the request"
        ], 404);

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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        if(isset($request->application_id)){

            // Find the Application
            if(\App\Application::where('id', $request->application_id)->exists()){

                $order = Order::where('application_id', $request->application_id)->where('user_id', $request->user()->id)->first();
                $order->delete();

                \Session::flash('alert-danger', 'Application removed !!!');
                return response()->json([
                    "success" => "OK: Order removed successfully"
                ], 200);

            } else {
                \Session::flash('alert-warning', 'An error ocurred, please try again !!!');
                return response()->json([
                    "error" => "Not Found: Application ID not found"
                ], 404);
            }
            
        }

        \Session::flash('alert-warning', 'An error ocurred, please try again !!!');
        return response()->json([
            "error" => "Not Found: No Application ID was found in the request"
        ], 404);

    }
}
