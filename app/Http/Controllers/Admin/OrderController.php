<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'order';
        $request = request();
        $query = Order::query();

        if ($order_number = $request->query('order_number')) {
            $query->where('number', 'LIKE', "2023%{$order_number}%");
        }
        if ($status = $request->query('status')) {
            $query->where('status', 'LIKE', "%{$status}%");
        }
        $orders = $query->paginate();
        return view('admin.orders.index', [
            'orders' => $orders,
            'title' => $title,
        ]);
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
        $order = Order::findOrFail($id);
        Order::destroy($id);
        return redirect()->route('orders.index')
            ->with('success', "Order($order->name) Deleted!");
    }

    public function trash()
    {
        $orders = Order::onlyTrashed()->paginate();
        return view('admin.orders.trash', [
            'orders' => $orders // Use correct variable name
        ]);
    }

    public function restore($id = null)
    {
        $order = Order::onlyTrashed()->findOrFail($id);
        $order->restore(); // Use instance method to restore
        return redirect()->route('orders.index')
            ->with('success', "Order($order->name) Restored!");
    }

    public function forceDelete($id = null)
    {
        if ($id) {
            $order = Order::onlyTrashed()->findOrFail($id);
            $order->forceDelete();
            return redirect()->route('orders.index')
                ->with('success', "Order($order->name) deleted forever!");
        }
        Order::onlyTrashed()->forceDelete();
        return redirect()->route('orders.index')
            ->with('success', "All trashed orders deleted forever.");
    }
}
