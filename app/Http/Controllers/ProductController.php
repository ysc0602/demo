<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductCoupon;
use App\Models\User;
use App\Services\ConvertService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    protected $converObj;

    public function __construct(ConvertService $converObj)
    {
        // ID Encryption Object
        $this->converObj = $converObj;
    }

    /**
     * Products List
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $products = Product::where('del_status', Product::DEL_STATUS['no'])->get();

        return view('product/product', ['products' => $products]);
    }

    /**
     * Add Product Page
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('product/addProduct');
    }

    /**
     * Save Product
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ], [
            'name.required' => 'Product Name Is Required',
            'image.required' => 'Upload Image Is Required',
            'image.image' => 'Upload Must Be Image'
        ]);

        // Save Uplode Image
        $imagePath = $request->file('image')->store('public');
        if (!$imagePath) {
            return redirect(url('/products/create'))->withErrors(['error' => 'Image Upload Failed']);
        }

        // Save Product
        $product = Product::create([
            'name' => $request->name,
            'image_path' => $imagePath
        ]);
        if (!$product) {
            return redirect(url('/products/createt'))->withErrors(['error' => 'Product Save Failed']);
        }

        return redirect('/products');
    }

    /**
     * Edit Product Page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $id = $this->converObj->stringToId($id);

        $product = Product::where('id', $id)->first();

        return view('product/editProduct', ['product' => $product]);
    }

    /**
     * Save Edit Product
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'required|image',
        ], [
            'name.required' => 'Product Name Is Required',
            'image.required' => 'Upload Image Is Required',
            'image.image' => 'Upload Must Be Image'
        ]);

        // Save Uplade Image
        $imagePath = $request->file('image')->store('public');
        if (!$imagePath) {
            return redirect(url('product/addProduct'))->withErrors(['error' => 'Image Upload Failed']);
        }

        $id = $this->converObj->stringToId($id);
        Product::where('id', $id)->update([
            'name' => $request->name,
            'image_path' => $imagePath
        ]);

        return redirect('/products');
    }

    /**
     * Delete Product
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $id = $this->converObj->stringToId($id);
        Product::where('id', $id)->update([
            'del_status' => Product::DEL_STATUS['yes']
        ]);

        return redirect('products');
    }

    /**
     * Add Product Coupon Page
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addProductCoupon($id)
    {
        $id = $this->converObj->stringToId($id);
        $product = Product::where('id', $id)->first();
        $productCouponIds = ProductCoupon::where('product_id', $id)->pluck('coupon_id')->toArray();
        $coupons = Coupon::where('del_status', Coupon::DEL_STATUS['no'])->get();

        return view('product/addProductCoupon', [
            'product' => $product,
            'coupons' => $coupons,
            'productCouponIds' => $productCouponIds
        ]);
    }

    /**
     * Save Add Product Coupon
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function saveProductCoupon(Request $request, $id)
    {
        $request->validate([
            'coupons' => 'required',
        ], [
            'coupons.required' => 'coupons Is Required',
        ]);

        $productId = $this->converObj->stringToId($id);

        DB::transaction(function () use ($request, $productId) {
            ProductCoupon::where('product_id', $productId)->delete();

            foreach ($request->coupons as $couponId) {
                $couponId = $this->converObj->stringToId($couponId);
                ProductCoupon::create([
                    'product_id' => $productId,
                    'coupon_id' => $couponId
                ]);
            }
        });

        return redirect('/products');
    }
}
