<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\Driver;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Order::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "bus_id"          => "required",
            "driver_id"       => "required",
            "contact_name"    => "required|string",
            "contact_phone"   => "required|string",
            "start_rent_date" => "required|date|after:today",
            "total_rent_days" => "required|integer|min:1"
        ]);
        if ($validator->fails()) {
            return response()->json(['message' => 'invalid field'], 422);
        }

        $endOrder = date('Y-m-d H:i:s', strtotime($request->start_rent_date . '+' . $request->total_rent_days . 'days'));
        $buses = Order::where('bus_id', $request->bus_id)->get();
        $drivers = Order::where('driver_id', $request->driver_id)->get();

        // Bus
        foreach ($buses as $bus) {
            $start = $bus['start_rent_date'];
            $end = date('Y-m-d H:i:s', strtotime($start . '+' . $bus['total_rent_days'] . 'days'));
            if ((strtotime($request->start_rent_date) <= strtotime($end)) && (strtotime($endOrder) >= strtotime($start))) {
                return response()->json(['message' => 'conflicting order or no available bus or driver'], 401);
            }
        }

        // Driver
        foreach ($drivers as $driver) {
            $start = $driver['start_rent_date'];
            $end = date('Y-m-d H:i:s', strtotime($start . '+' . $driver['total_rent_days'] . 'days'));;

            if ((strtotime($request->start_rent_date) <= strtotime($end)) && (strtotime($endOrder) >= strtotime($start))) {
                return response()->json(['message' => 'conflicting order or no available bus or driver'], 401);
            }
        }

        $order = Order::create($request->except('token'));
        $bus = Bus::where('id', $order->bus_id)->first()->plate_number;
        $driver = Driver::where('id', $order->driver_id)->first()->name;

        $order['bus'] = $bus;
        $order['driver'] = $driver;
        
        return response()->json($order, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return response()->json(['message' => 'delete order success'], 200);
    }
}
