<?php

namespace App\Http\Controllers;

use App\Events\OrderCreated;
use App\Mail\OrderInvoice;
use App\Models\Order;
use App\Models\User;
use App\Notifications\OrderCreatedNotification;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
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

            // broadcast & Notifications
            event(new OrderCreated($order));

            // send email for one user :

            // $user = User::where('type', 'super-admin')->first(); // retrieve the first matching user
            // $user->notify(new OrderCreatedNotification($order)); // call the notify method on the user instance

            // send email for multi user  :

            $users = User::whereIn('type', ['super-admin', 'admin'])->get();

            // way 1
            /*  foreach ($users as $user) {
                $user->notify(new OrderCreatedNotification($order));
            }*/

            // way 2
            Notification::send($users, new OrderCreatedNotification($order));
            /*Notification::route('mail', ['info@example.com', 'admin@example.com'])
                ->notify(new OrderCreatedNotification($order));
            */
            /*
            Mail::to($order->billing_email)->send(new OrderInvoice($order));
           */
            // هان بنختار وين نوجه المستخدم سواء على صفحة الدفع او على الاورد حسب شو بدك
            // call route to orders by name orders with success massage

            return redirect()->route('order.payments.create', $order->id)->with('success', __('Order Created'));
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
