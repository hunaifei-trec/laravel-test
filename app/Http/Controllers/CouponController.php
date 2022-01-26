<?php

namespace App\Http\Controllers;

use Ramsey\Uuid\Uuid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Interfaces\CouponRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\CouponProductRepository;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    private $couponRepository;
    private $productRepository;
    private $couponProductRepository;

    public function __construct(CouponRepositoryInterface $couponRepository)
    {
        $this->couponRepository = $couponRepository;
        $this->productRepository = new ProductRepository();
        $this->couponProductRepository = new CouponProductRepository();
    }

    public function lists(Request $request)
    {
        $search = $request->input('Coupon');
        $searchName = null;
        if (!empty($search)) {
            $searchName = $search['name'];
        }
        $coupons = $this->couponRepository->findAll($searchName);
        return view('coupon.lists', [
            'coupons' => $coupons,
        ]);
    }

    public function detail($id)
    {
        $coupon = $this->couponRepository->detail($id);
        return view('coupon.detail', [
            'coupon' => $coupon
        ]);
    }

    public function create(Request $request)
    {
        $coupon = null;
        if ($request->isMethod('POST')) {
            $validator = \Validator::make($request->input(), [
                'Coupon.name' => 'required|unique:coupons,name',
            ], [
                'unique' => ':attribute cannot be repeated',
                'required' => ':attribute is required',
            ], [
                'Coupon.name' => 'name',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $data = $request->input('Coupon');
            $couponId = Uuid::uuid4();
            $data['coupon_id'] = $couponId;
            $data['created_by'] = Auth::user()->id;
            $data['start_date'] = date('Y-m-d', strtotime($data['start_date']));
            $data['end_date'] = date('Y-m-d', strtotime($data['end_date']));

            $coupon = $this->couponRepository->create($data);
            if ($coupon) {
                if (!empty($data['product_ids'])) {
                    $productArr = explode(',', $data['product_ids']);
                    if(count($productArr) > 0) {
                        for ($i=0; $i < count($productArr); $i++) {
                            $couponProductData['product_id'] = $productArr[$i];
                            $couponProductData['coupon_id'] = $couponId;
                            $this->couponProductRepository->create($couponProductData);
                        }
                    }
                }
                $mailTo = Auth::user()->email;
                $this->sendMail($mailTo, $data['name']);
                return redirect('coupon/lists')->with('success', 'Create Success');
            } else {
                return redirect()->back();
            }
        }

        $products = $this->productRepository->findAll();
        return view('coupon.create', [
            'coupon' => $coupon,
            'products'=> $products
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'Coupon.name' => 'required|unique:coupons,name,'  .$id.',coupon_id',
            ], [
                'required' => ':attribute is required',
                'unique' => ':attribute cannot be repeated',
                'integer' => ':attribute must be an integer',
            ], [
                'Coupon.name' => 'name',
            ]);

            $data = $request->input('Coupon');
            $data['updated_by'] = Auth::user()->id;
            $productIds = $data['product_ids'];
            unset ($data['product_ids']);
            if ($this->couponRepository->update($data, $id)) {
                $this->couponProductRepository->delete($id);
                if (!empty($productIds)) {
                    $productArr = explode(',', $productIds);
                    if(count($productArr) > 0) {
                        for ($i=0; $i < count($productArr); $i++) {
                            $couponProductData['product_id'] = $productArr[$i];
                            $couponProductData['coupon_id'] = $id;
                            $this->couponProductRepository->create($couponProductData);
                        }
                    }
                }
                return redirect('coupon/lists')->with('success', 'Update Success: ' . $id);
            }
        }

        $coupon = $this->couponRepository->detail($id);
        $productIds = '';
        if (!empty($coupon->products) && count($coupon->products) > 0) {
            foreach ($coupon->products as $pro) {
                $productIds .= $pro->id.',';
            }
        }
        $coupon['product_ids'] = $productIds;
        $products = $this->productRepository->findAll();
        return view('coupon.update', [
            'coupon' => $coupon,
            'products'=> $products
        ]);
    }

    public function delete($id)
    {
        if ($this->couponRepository->delete($id)) {
            return redirect('coupon/lists')->with('success', 'Delete Success:' . $id);
        } else {
            return redirect('coupon/lists')->with('error', 'Delete Fail:' . $id);
        }
    }

    public function sendMail($mailTo,$couponName) {
        $subject = 'Coupon Notification';
        $contents = 'Coupon '.$couponName.' Create Success';
        Mail::send('coupon.mail', ['contents'=>$contents], function($message) use ($mailTo, $subject){
            $message ->to($mailTo)->subject($subject);
        });
        if (count(Mail::failures()) < 1) {
            return true;
        } else {
            return false;
        }
    }
}
