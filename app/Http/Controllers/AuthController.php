<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Categories;
use Illuminate\Support\Facades\Session;
use App\Models\Products;
use App\Models\Bills;



class AuthController extends Controller
{
    protected $pro;
    protected $categories;

    public function __construct()
    {
        $this->pro = new Products();
        $this->categories = new Categories();
        //$this->middleware('auth')->except(['formRegister', 'register', 'login']);
    }
    public function index()
    {
        $productSale = $this->pro->productsSale();
        $productBest = $this->pro->productsKhamPha();
        $productBycategory = $this->pro->loadBycategory();
        $productBythuonghieu = $this->pro->loadByThuongHieu();
        $categories = $this->categories->queryCat();
        $pagina = Products::paginate(5);
        return view("index", compact('productSale', 'productBest', 'pagina', 'categories', 'productBycategory', 'productBythuonghieu'));
    }
    public function formRegister()
    {
        $categories = $this->categories->queryCat();
        return view("Clients/Contents.register", compact("categories"));
    }

    public function register(Request $request)
    {
        $user = Users::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);
        return redirect()->route('formlogin');
    }

    public function formLogin()
    {
        $categories = $this->categories->queryCat();
        return view("Clients/Contents.login", compact("categories"));
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');

        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return redirect()->back()->withInput()->with('error', 'Email hoặc mật khẩu không chính xác');
            }
        } catch (JWTException $e) {
            return redirect()->back()->withInput()->with('error', 'Đã có lỗi xảy ra khi đăng nhập');
        }

        $user = JWTAuth::user();
        Session::put('user', $user); // Lưu thông tin người dùng vào session
        Session::put('token', $token);

        return redirect()->route('index');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route("index");
    }
    public function inforuser()
    {
        $id_user = Session::get('user')->id;
        $user = Users::where('id', $id_user)->first();
        $categories = $this->categories->queryCat();

        return view('Clients/Contents.inforuser', compact('user', 'categories'));
    }
    public function updateuser(Request $request)
    {
        $user = Users::find(Session::get('user')->id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');
        $user->role = $request->input('role');

        // Handle file upload
        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            $user->img = $imageName;
        }

        // Save changes to the database
        $user->save();
        return redirect()->route('inforuser');
    }
    public function followorder()
    {
        $id_user = Session::get('user')->id;
        $user = Users::where('id', $id_user)->first();
        $bill =  Bills::where('id_user', $id_user)->orderBy('id', 'desc')->where('status', 1)->get();

        $categories = $this->categories->queryCat();
        return view("Clients/Contents/ordered.followorder", compact('user', 'bill', 'categories'));
    }
    public function delivering()
    {
        $id_user = Session::get('user')->id;
        $user = Users::where('id', $id_user)->first();
        $bill =  Bills::where('id_user', $id_user)->orderBy('id', 'desc')->where('status', 2)->get();

        $categories = $this->categories->queryCat();
        return view("Clients/Contents/ordered.followorder", compact('user', 'bill', 'categories'));
    }
    public function reserved()
    {
        $id_user = Session::get('user')->id;
        $user = Users::where('id', $id_user)->first();
        $bill =  Bills::where('id_user', $id_user)->orderBy('id', 'desc')->where('status', 3)->get();

        $categories = $this->categories->queryCat();
        return view("Clients/Contents/ordered.followorder", compact('user', 'bill', 'categories'));
    }
    public function canceled()
    {
        $id_user = Session::get('user')->id;
        $user = Users::where('id', $id_user)->first();
        $bill =  Bills::where('id_user', $id_user)->orderBy('id', 'desc')->where('status', 4)->get();

        $categories = $this->categories->queryCat();
        return view("Clients/Contents/ordered.followorder", compact('user', 'bill', 'categories'));
    }
    public function cancelorder(Request $request, $id)
    {
        $status = $request->input('status');
        $request = $request->all();

        $bill = Bills::find($id);
        if ($bill) {
            if ($status == 1) {
                $bill->status = 4;
                $bill->save();
            }
        }

        return redirect()->route('canceled');
    }
}
