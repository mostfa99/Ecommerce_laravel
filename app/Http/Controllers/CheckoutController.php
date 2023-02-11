<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Intl\Countries;

use Throwable;

class CheckoutController extends Controller
{
    /**
     * @var \App\Repositories\Cart\CartRepository;
     *
     */
    protected $cart;

    public function __construct(CartRepository $cart)
    {
        $this->cart = $cart;
    }
    public function create()
    {
        return view('front.checkout', [
            'cart' => $this->cart,
            'user' => Auth::user(),
            'countries' => Countries::getNames(App::currentLocale()),

        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'billing_name' => ['required', 'string'],
            'billing_phone' => 'required',
            'billing_email' => 'required|email',
            'billing_city' => 'required',
            'billing_country' => 'required',
        ]);
        DB::beginTransaction();
        try {
            $request->merge([
                'total' => $this->cart->total(),
            ]);
            $items = [];
            // to insert in order table
            $order = Order::create($request->all());
            // عشان اجيب كل منتجات السلة

            foreach ($this->cart->all() as $item) {
                // two way to the same result : way 1 & way 2
                $items[] = [
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ];
            }
            DB::table('order_items')->insert($items);
            DB::commit();

            event(new OrderCreated($order));

            // هان بنختار وين نوجه المستخدم سواء على صفحة الدفع او على الاورد حسب شو بدك
            // call route to orders by name orders with success massage
            return redirect()->route('orders')->with('success', __('Order Created'));
        } catch (Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }
}
  // way 1
                /* $order->items()->create([
                    // 'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,

                ]);*/
                // way 2
                /*
                $order->product()->attach($item->product_id, [
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);*/