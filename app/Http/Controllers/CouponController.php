<?php

namespace App\Http\Controllers;

use App\Mail\CreateCoupon;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\User;
use App\Services\ConvertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class CouponController extends Controller
{
    protected $converObj;

    public function __construct(ConvertService $converObj)
    {
        // ID Encryption Object
        $this->converObj = $converObj;
    }

    /**
     * Coupons List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $coupons = Coupon::where('del_status', Coupon::DEL_STATUS['no'])->get();

        return view('coupon/coupon', ['coupons' => $coupons]);
    }


    /**
     * Add coupon Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('coupon/addCoupon');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|gte:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ], [
            'name.required' => 'Coupon Name Is Required',
            'amount.required' => 'Amount Is Required',
            'start_time.required' => 'Start Time Is Required',
            'start_time.date' => 'Start Time Must Be Date',
            'end_time.image' => 'End Time Is Required',
            'end_time.date' => 'End Time Must Be Date'
        ]);

        if (strtotime($request->start_time) < time() || strtotime($request->end_time) < time()) {
            return redirect(url('/coupons/create'))
                ->withErrors(['error' => 'Start Time And End Time Greater Than Current Time']);
        }

        if (strtotime($request->start_time) > strtotime($request->end_time)) {
            return redirect(url('/coupons/create'))
                ->withErrors(['error' => 'Start Time Greater Than End Time']);
        }

        // Save Product
        $coupon = Coupon::create([
            'name' => $request->name,
            'amount' => $request->amount,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);
        if (!$coupon) {
            return redirect(url('/coupons/create'))->withErrors(['error' => 'coupon Save Failed']);
        }

        // Send Email
        $userId = Session::get('userId');
        $user = User::whereId($userId)->first();
        Mail::to($user->email)->send(new CreateCoupon($coupon));

        return redirect('/coupons');
    }

    /**
     * Edit coupon Page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = $this->converObj->stringToId($id);

        $coupon = Coupon::where('id', $id)->first();

        return view('coupon/editCoupon', ['coupon' => $coupon]);
    }

    /**
     * Save Edit coupon
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'amount' => 'required|gte:0',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
        ], [
            'name.required' => 'Product Name Is Required',
            'start_time.required' => 'Start Time Is Required',
            'start_time.date' => 'Start Time Must Be Date',
            'end_time.image' => 'End Time Is Required',
            'end_time.date' => 'End Time Must Be Date'
        ]);

        if (strtotime($request->start_time) < time() || strtotime($request->end_time) < time()) {
            return redirect(url('/coupons/create'))
                ->withErrors(['error' => 'Start Time And End Time Greater Than Current Time']);
        }

        if (strtotime($request->start_time) > strtotime($request->end_time)) {
            return redirect(url('/coupons/create'))
                ->withErrors(['error' => 'Start Time Greater Than End Time']);
        }

        $id = $this->converObj->stringToId($id);
        Coupon::where('id', $id)->update([
            'name' => $request->name,
            'amount' => $request->amount,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ]);

        return redirect('/coupons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $id = $this->converObj->stringToId($id);
        Coupon::where('id', $id)->update([
            'del_status' => Coupon::DEL_STATUS['yes']
        ]);

        return redirect('coupons');
    }

    /**
     * Coupon Product List
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function couponProductList($id)
    {
        $id = $this->converObj->stringToId($id);
        $productIds = ProductCoupon::where('coupon_id', $id)->pluck('product_id');

        $products = [];
        foreach ($productIds as $productId) {
            $productId = $this->converObj->stringToId($productId);
            $product = Product::whereId($productId)->first();
            $products[] = [
                'name' => $product->name,
                'created_at' => $product->created_at
            ];
        }

        return view('coupon/couponProductList', ['products' => $products]);
    }
}
