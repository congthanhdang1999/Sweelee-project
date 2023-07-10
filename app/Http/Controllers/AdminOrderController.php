<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\OrderConfirmation;
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

    public function __construct(Order $order, Product $product)
    {
        $this->order = $order;
        $this->product = $product;
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
        } elseif ($statusOrder == "cancel") {
            $orders = $this->order->onlyTrashed()->paginate(8);
            //dd($orders);
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
        $count_order_cancel = $this->order->onlyTrashed()->count();
        $count = [$count_order_all, $count_order_processing, $count_order_delivery, $count_order_success, $count_order_cancel];

        //$orders = $this->order->paginate(8);
        //dd($count);
        return view('admin.order.list', compact('orders', 'count'));
    }
    public function create(Request $request)
    {

        try {
            DB::beginTransaction();
            $dataCustomerCreate = [
                'name' => $request->fullname,
                'email' => $request->email,
                'address' => $request->address,
                'phone' => $request->phone
            ];
            //dd($dataCustomerCreate);
            $number = Str::random(5);
            $upperNumber = Str::upper($number);
            $code = 'VN-' . $upperNumber;
            $customer = $this->order->customer()->create($dataCustomerCreate);
            $dataOrderCreate = [
                'customer_id' => $customer->id,
                'code' => $code,
                'total' => Session::get('cartTotal')[0],
                'status' => 0,
            ];
            //dd($dataOrderCreate);
            $orderCreate = $this->order->create($dataOrderCreate);
            foreach (Session::get('item_order') as $item) {
                
                $orderCreate->orderDetails()->create([
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
        } catch (Exception $exception) {
            DB::rollBack();
            Log::error('message:' . $exception->getMessage() . '---line' . $exception->getLine());
        }
        //merge $dataCustomerCreate,$dataOrderCreate,$dataDetailOrder
        //dd($dataDetailOrder);
        //dd($request->email);
        $dataOrderConfirmation = array_merge($dataCustomerCreate, $dataOrderCreate);
        // //dd($dataOrderConfirmation);
        //dd(Session::get('item_order'));
        Mail::to($request->email)->send(new OrderConfirmation($dataOrderConfirmation));
        foreach (Session::get('item_order') as $item) {
            Cart::remove($item->rowId);
        }
        $request->session()->pull('item_order', 'cartTotal');
        Alert::success('Đặt hàng thành công', 'Xin cảm ơn!');
        return redirect()->route('home');

    }

    public function detail($id)
    {
        $detailOrder = $this->order->find($id);
        $selectStatus = ['Đang xử lý', 'Đang giao hàng', 'Hoàn thành'];
        $products = DB::table('detail_orders')
            ->join('products', 'products.id', '=', 'detail_orders.product_id')
            ->where('detail_orders.order_id', $id)
            ->get();
        //dd($products);
        return view('admin.order.detail', compact('detailOrder', 'products', 'selectStatus'));
    }
    public function update(Request $request, $id)
    {
        $this->order->find($id)->update([
            'status' => (int)$request->input('status')
        ]);
        //return $request->all();
        return redirect()->route('order.index')->with('status', 'Bạn đã chuyển tình trạng đơn hàng thành công');
    }
    public function delete($id)
    {
        $recovery = DetailOrder::where('order_id', $id)->get();
        //dd($recovery);
        foreach ($recovery as $item) {
            $product = $this->product->find($item->product_id);
            $quantity = $product->quantity + $item->quantity;
            $this->product->find($item->product_id)->update([
                'quantity' => $quantity
            ]);
        }
        $this->order->find($id)->delete();
        return redirect()->route('order.index')->with('status', 'Bạn đã xoá đơn hàng thành công');
    }
}
