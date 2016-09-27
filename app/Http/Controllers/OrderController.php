<?php

namespace App\Http\Controllers;


use Faker\Provider\Uuid;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Order;
use App\InvoiceItems;
use League\Flysystem\Exception;
use Validator;
use Illuminate\Support\Facades\DB;

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
            'guid' => uniqid(),
            'a_name' => 'required|max:50|regex:/^[(a-zA-Z\s)]+$/u|min:2|string',
            'a_phone' => 'required|size:8|string',
            'a_email' => 'required|email|string',
            'a_address' => 'required|string',
            'a_zipcode' => 'required|size:4|string',
            'a_city' => 'required|string',
            'a_time' => 'required',

            'l_name' => 'required|max:50|regex:/^[(a-zA-Z\s)]+$/u|min:2|string',
            'l_phone' => 'required|size:8|string',
            'l_email' => 'required|email|string',
            'l_address' => 'required|string',
            'l_zipcode' => 'required|size:4|string',
            'l_city' => 'required|string',
            'l_time' => 'required'
        ]);

        if ($validator->fails())
            return redirect('/order')
                ->withErrors($validator)
                ->withInput();

        Order::unguard();
        $guid = strtoupper(Uuid::uuid(4));  // Generate a random hash with dashes
        $guid = explode('-', $guid);         // Get the text between each dash
        $guid = end($guid);                 // Pick the last string
        Order::create([
            'guid' => $guid,

            'a_name' => $request->input('a_name'),
            'a_phone' => $request->input('a_phone'),
            'a_email' => $request->input('a_email'),
            'a_address' => $request->input('a_address'),
            'a_zipcode' => $request->input('a_zipcode'),
            'a_city' => $request->input('a_city'),
            'a_time' => strtotime($request->input('a_time')),

            'l_name' => $request->input('l_name'),
            'l_phone' => $request->input('l_phone'),
            'l_email' => $request->input('l_email'),
            'l_address' => $request->input('l_address'),
            'l_zipcode' => $request->input('l_zipcode'),
            'l_city' => $request->input('l_city'),
            'l_time' => strtotime($request->input('l_time'))
        ]);

        $n = 1;
        foreach ($request->input('items') as $item) {
            for ($i = 1; $i <= $item['amount']; $i++) {
                InvoiceItems::create([
                    'weight' => $item['weight'],
                    'width' => $item['width'],
                    'height' => $item['height'],
                    'depth' => $item['length'],
                    'invoice_id' => $guid,
                    'trackingnumber' => $guid . '-' . $n . '-' . $i,
                    'item_type' => $item['type'],
                    'group' => $guid . '-' . $n
                ]);
            }
            $n++;
        }

        return redirect('/order/show/' . $guid);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        $order = Order::find($id);
        if ($order)
            return view('orders.show', [
                'data' => [
                    'order' => $order,
                    'groups' => InvoiceItems::where('invoice_id', $id)->distinct('group')->get(),
                    'items' => InvoiceItems::where('invoice_id', $id)->get()
                ]
            ]);
        else
            abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
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
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        //
    }

    /**
     * Get tracking data for shipment
     *
     * @param Requests\trackOrder $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public
    function track(Requests\trackOrder $request)
    {
        return redirect('/order/show/' . $request->input('trackingnumber'));
    }

    /**
     * Updates the tracking for a specific shipment
     *
     * @param String $guid
     */
    public
    function updateTracking($guid)
    {
        if (str_contains($guid, ':')) {
            DB::table('invoice_items_tracking')->insert([
                'trackingnumber' => $guid,
                'timestamp' => strtotime('now'),
                'status' => count(DB::table('invoice_items_tracking')->where('trackingnumber', $guid)->get())
            ]);
        }
        var_dump($guid);
    }

    /**
     * Return all label for print from a given invoice ID
     *
     * @param $guid
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLabels($guid){
        $items = InvoiceItems::where('invoice_id', $guid)->get();

        return view('labels', ['items' => $items]);
    }
}
