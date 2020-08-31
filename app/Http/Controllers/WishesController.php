<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Wish;

class WishesController extends Controller
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
        $new_wish = Wish::create([
            'user_id' => $request->user_id,
            'application_id' => $request->application_id
        ]);

        // \Session::flash('alert-success', 'App added to your wishes !!!');

        return redirect()->back()->with('alert-success', 'App added to your wishes !!!');
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
        $wish = Wish::where([['user_id', $request->user_id], ['application_id', $request->application_id]])->firstOrFail();
        
        $wish->delete();

        // \Session::flash('alert-danger', 'App removed from your wishes !!!');

        return redirect()->back()->with('alert-danger', 'App removed from your wishes !!!');
    }
}
