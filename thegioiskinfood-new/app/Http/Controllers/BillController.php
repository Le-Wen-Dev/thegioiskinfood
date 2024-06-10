<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Categories;
use App\Models\Bills;
use App\Models\Carts;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class BillController extends Controller
{
    protected $pro;
    protected $categories;
    protected $carts;

    public function __construct(CartController $cartController)
    {
        $this->pro = new Products();
        $this->categories = new Categories();
        $this->carts = $cartController;
    }
    public function index()
    {

        $id_user = Session::get('user')->id;
        $user = Session::get('user');
        $cart = Carts::where('id_user', $id_user)->get();
        $categories = $this->categories->queryCat();
        return view('Clients/Contents.bill', compact('user', 'categories', 'cart'));
    }
    public function createBill(Request $request)
    {
        $userId = Session::get('user')->id;
        $idBill = Str::random(10);
        $mavandon = random_int(10000000, 99999999);
        $requestData = $request->all();


        $totalfinal = $request->input('totalfinal');
        $productsData = [];
        foreach ($requestData['products'] as $product) {
            $productData = [
                'id' => $product['id'],
                'name' => $product['name'],
                'img' => $product['img'],
                'quantity' => $product['quantity'],
                'total' => $product['total'],
            ];
            $productsData[] = $productData;
        }

        $billData = [
            'id_user' => $userId,
            'id_bill' => $idBill,
            'product' => json_encode($productsData),
            'name' => $requestData['name'],
            'email' => $requestData['email'],
            'phone' => $requestData['phone'],
            'address' => $requestData['full_address'],
            'totalfinal' => $totalfinal,
            'mavandon' => $mavandon,
            'payment_methods' => $requestData['payment_methods'],
            'ship' => $requestData['ship'],
        ];

        $createdBill = Bills::create($billData);
        // Session::put('bill_data', $billData);
        // return redirect()->route('showbillss');
        return redirect()->route('bill.show', ['id' => $createdBill->id]);
    }

    public function showTempBill()
    {
        $categories = $this->categories->queryCat();
        return view('Clients/Contents.sessionbill', compact('categories'));
    }
    public function completeBill(Request $request)
    {
        $billData = Session::get('bill_data');
        $createdBill = Bills::create($billData);
        return redirect()->route('bill.show', ['id' => $createdBill->id]);
    }
    public function showBill($id)
    {
        $bill = Bills::findOrFail($id);
        $categories = $this->categories->queryCat();
        return view('Clients/Contents.sessionbill', compact('bill', 'categories'));
    }
}
