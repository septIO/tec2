<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\InvoiceItems;
use Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('order');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'a_name'    => 'required|max:50|regex:/^[(a-zA-Z\s)]+$/u|min:2|string',
            'a_phone'   => 'required|size:8|string',
            'a_email'   => 'required|email|string',
            'a_address' => 'required|string',
            'a_zipcode' => 'required|size:4|string',
            'a_city'    => 'required|string',
            'a_time'    => 'required',

            'l_name'    => 'required|max:50|regex:/^[(a-zA-Z\s)]+$/u|min:2|string',
            'l_phone'   => 'required|size:8|string',
            'l_email'   => 'required|email|string',
            'l_address' => 'required|string',
            'l_zipcode' => 'required|size:4|string',
            'l_city'    => 'required|string',
            'l_time'    => 'required'
        ]);

        if($validator->fails())
            return redirect('/order')
                ->withErrors($validator)
                ->withInput();

        Order::create([
            'a_name'    => $request->input('a_name'),
            'a_phone'   => $request->input('a_phone'),
            'a_email'   => $request->input('a_email'),
            'a_address' => $request->input('a_address'),
            'a_zipcode' => $request->input('a_zipcode'),
            'a_city'    => $request->input('a_city'),
            'a_time'    => $request->input('a_time'),

            'l_name'    => $request->input('l_name'),
            'l_phone'   => $request->input('l_phone'),
            'l_email'   => $request->input('l_email'),
            'l_address' => $request->input('l_address'),
            'l_zipcode' => $request->input('l_zipcode'),
            'l_city'    => $request->input('l_city'),
            'l_time'    => $request->input('l_time')
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('orders.show', [
            'data' => [
                'order' => Order::find($id),
                'items' => InvoiceItems::where('invoice_id', $id)->get()
                ]
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function track(Requests\trackOrder $request){
        return redirect('/order/show/'.$request->input('trackingnumber'));
    }
}
