<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\OrderConfirmation;
use App\User;
use PhpParser\Node\Stmt\TryCatch;
use App\DetailOrder;
use App\Order;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;

class AdminOrderController extends Controller
{
    private $order;
    private $product;
    private $user;
    private $detailOrder;

    public function __construct(Order $order, Product $product, User $user, DetailOrder $detailOrder)
    {
        $this->order = $order;
        $this->product = $product;
        $this->user = $user;
        $this->detailOrder = $detailOrder;
    }

    public function show(Request $request)
    {
        $search = "";

        $statusOrder = $request->input('statusOrder');
        if ($statusOrder == "processing") {
            $orders = $this->order->where('status', 0)->paginate(8);
        } elseif ($statusOrder == "delivery") {
            $orders = $this->order->where('status', 1)->paginate(8);
        } elseif ($statusOrder == "success") {
            $orders = $this->order->where('status', 2)->paginate(8);
        } elseif ($statusOrder == "cancel"){
            $orders = $this->order->where('status', 3)->paginate(8);
        } else {
            if ($request->input('search')) {
                $search = $request->input('search');
            }
            $orders = $this->order->where('code', 'like', "%{$search}%")->orderBy('id', 'DESC')->paginate(8);
        }
        $count_order_all = $this->order->count();
        $count_order_processing = $this->order->where('status', 0)->count();
        $count_order_delivery = $this->order->where('status', 1)->count();
        $count_order_success = $this->order->where('status', 2)->count();
        $count_order_cancel = $this->order->where('status', 3)->count();
        $count = [$count_order_all, $count_order_processing, $count_order_delivery, $count_order_success,$count_order_cancel];

        return view('admin.order.list', compact('orders', 'count'));
    }

    public function create(Request $request)
    {

        try {
            DB::beginTransaction();
            $dataCustomerCreate = [
                'name' => $request->input('fullname'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone')
            ];
            //dd($dataCustomerCreate);
            $number = Str::random(5);
            $upperNumber = Str::upper($number);
            $code = 'VN-' . $upperNumber;
            $customer = $this->order->customer()->create($dataCustomerCreate);
            $dataOrderCreate = [
                'user_id' => Auth::user()->id,
                'code' => $code,
                'total' => Session::get('cartTotal')[0],
                'status' => 0,
            ];
            //dd($dataOrderCreate);
            //dd(Session::get('item_order'));
            $orderCreate = $this->order->create($dataOrderCreate);
            foreach (Session::get('item_order') as $item) {
                $orderSuccess = $orderCreate->orderDetails()->create([
                    'name' => $item->name,
                    'price' => $item->price,
                    'quantity' => $item->qty,
                    'order_id' => $orderCreate->id,
                    'product_id' => $item->id
                ]);
            }
            foreach (Session::get('item_order') as $item) {
                $product = $this->product->find($item->id);
                $quantity = $product->quantity - $item->qty;
                $this->product->find($item->id)->update([
                    'quantity' => $quantity
                ]);
            }
            DB::commit();

            $dataOrderConfirmation = array_merge($dataCustomerCreate, $dataOrderCreate);
            $sendMail = Mail::to($request->email)->send(new OrderConfirmation($dataOrderConfirmation));

            foreach (Session::get('item_order') as $item) {
                Cart::remove($item->rowId);
            }
            $request->session()->pull('item_order', 'cartTotal');
            Alert::success('Đặt hàng thành công', 'Xin cảm ơn!');
            return redirect()->route('home');

        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '---line' . $exception->getLine());
        }


        //merge $dataCustomerCreate,$dataOrderCreate,$dataDetailOrder
        //dd($dataDetailOrder);
        //dd($request->email);
//
//        //dd($dataOrderConfirmation);
//        //dd(Session::get('item_order'));
//        Mail::to($request->email)->send(new OrderConfirmation($dataOrderConfirmation));
//        foreach (Session::get('item_order') as $item) {
//            Cart::remove($item->rowId);
//        }
//        $request->session()->pull('item_order', 'cartTotal');
//        Alert::success('Đặt hàng thành công', 'Xin cảm ơn!');
//

    }

    public function detail($id)//id đơn hàng
    {
        $id = (int)($id);

        $dataUserOrder = DB::table('orders')
            ->select('*')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->join('informations', 'informations.id', '=', 'users.id')
            ->where('orders.id', '=', $id)
            ->get();
        //dd($dataUserOrder->name);
//        return $dataUserOrder;
        $detailOrder = $this->order->find($id);//chi tiết đơn hàng của từ id
        $detailOrderProduct = $this->detailOrder->where('order_id', $id)->get();
//return $detailOrderProduct ;
        $selectStatus = ['Đang xử lý', 'Đang giao hàng', 'Hoàn thành', 'Đã huỷ'];
//        $products = DB::table('detail_orders')
//            ->join('products', 'products.id', '=', 'detail_orders.product_id')
//            ->where('detail_orders.order_id', $id)
//            ->get();

        return view('admin.order.detail', compact('detailOrder', 'detailOrderProduct', 'selectStatus', 'dataUserOrder'));
    }

    public function update(Request $request, $id)
    {

        $this->order->find($id)->update([
            'status' => (int)$request->input('status')
        ]);

        return redirect()->route('order.index')->with('status', 'Bạn đã chuyển tình trạng đơn hàng thành công');
    }


}
