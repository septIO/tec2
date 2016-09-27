<?php

namespace App\Http\Controllers;

use App\InvoiceItems;
use App\Order;
use App\Tracking;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UpdateTracking extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($guid)
    {
        $invoiceStatus = Order::find(Order::getInvoiceID($guid))->status;
        $items = DB::select(DB::raw("
          SELECT * FROM invoice_items 
          WHERE trackingnumber NOT IN 
            (SELECT trackingnumber FROM invoice_items_tracking WHERE status = :invoiceStatus)
          AND invoice_id = :guid"), ['guid' => $guid, 'invoiceStatus' => $invoiceStatus]
        );
        return view('update-tracking-started', ['started' => true, 'guid' => $guid, 'items' => $items]);
    }

    /**
     * Initiate the tracking updates for a single order.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function startTracking(Request $request)
    {
        $order = Order::find($request->input('trackingnumber'));
        if (!$order)
            abort(404);
        $order->increment('status');
        return redirect('tracking/update/' . $request->input('trackingnumber'));
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
        $number = str_replace('+', '-', $request->input('trackingnumber'));
        $invoiceID = preg_match('([0-9a-fA-F]+)',$number, $matches);
        $order = Order::find($matches[0]);

        Tracking::updateOrCreate([
            'trackingnumber' => $number
        ], [
            'status' => $order->status
        ]);
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
