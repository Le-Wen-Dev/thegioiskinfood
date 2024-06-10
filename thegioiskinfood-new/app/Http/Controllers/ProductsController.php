<?php

namespace App\Http\Controllers;


use App\Models\Products;
use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\Carts;
use App\Models\Hearths;
use Illuminate\Support\Facades\Session;

class ProductsController extends Controller
{
    protected $pro;
    protected $categories;

    public function __construct()
    {
        $this->pro = new Products();
        $this->categories = new Categories();
    }
    public function index()
    {
        $productSale = $this->pro->productsSale();
        $productBest = $this->pro->productsKhamPha();
        $productBycategory = $this->pro->loadBycategory();
        $productBythuonghieu = $this->pro->loadByThuongHieu();
        $categories = $this->categories->queryCat();
        $pagina = Products::paginate(5);
        $cartItems = Carts::all();
        $inactiveCategories = Categories::where('status', 1)->pluck('id');

        // Lấy danh sách sản phẩm trang chủ, loại bỏ sản phẩm thuộc các danh mục đã ngưng bán
        $pagina = Products::whereNotIn('category_id', $inactiveCategories)->paginate(5);
        return view('index', compact('productSale', 'productBest', 'pagina', 'categories', 'productBycategory', 'productBythuonghieu', 'cartItems'));
    }


    public function getDetail(Request $request)
    {

        $detail = $this->pro->productDetail($request->id);
        $productSale = $this->pro->productsSale();
        $categories = $this->categories->queryCat();
        return view('Clients/contents.detail', compact('detail', 'productSale', 'categories'));
    }
    public function search(Request $request)
    {

        $query = $request->input('query');
        $product = Products::where('name', 'LIKE', "%$query%")->paginate(5);

        $categories = $this->categories->queryCat();
        // $pagina = Products::paginate(5);
        return view('Clients/Contents.search', compact('query', 'product', 'categories'));
    }
    public function proByCategory()
    {
        $productSale = $this->pro->productsSale();
        $productBest = $this->pro->productsKhamPha();
        $productBycategory = $this->pro->loadBycategory();
        $productBythuonghieu = $this->pro->loadByThuongHieu();
        $categories = $this->categories->queryCat();
        $pagina = Products::paginate(5);
        return view('Clients/Contents.loadProByCat', compact('productSale', 'productBest', 'pagina', 'categories', 'productBycategory', 'productBythuonghieu'));
    }
    public function categorylv1()
    {
        $productSale = $this->pro->productsSale();
        $productBest = $this->pro->productsKhamPha();
        $productBycategory = $this->pro->loadBycategory();
        $productBythuonghieu = $this->pro->loadByThuongHieu();
        $categories = $this->categories->queryCat();
        $pagina = Products::paginate(5);
        return view('Clients/Contents.loadProByCat', compact('productSale', 'productBest', 'pagina', 'categories', 'productBycategory', 'productBythuonghieu'));
    }

    public function categorylv3(Request $request, $categories_id)
    {
        $categories = $this->categories->queryCat();
        $loadallcate = $this->categories->handleCategories();
        $categoryNameDynamic = $this->categories->loadNameCatDynamic($categories_id);
        $productBest = $this->pro->getProByCatWhereId($categories_id);
        $pagina = Products::paginate(5);
        return view('Clients/Contents.loadProByCat', compact('productBest', 'categories', 'loadallcate', 'pagina', 'categoryNameDynamic'));
    }
    public function productHearth(Request $request)
    {

        $hearth = new Hearths();
        $hearth->user_id = $request->input('user_id');
        $hearth->product_id = $request->input('product_id');
        $hearth->img = $request->input('img');
        $hearth->name = $request->input('name');
        $hearth->price = $request->input('price');
        $heart = Hearths::where('user_id', $hearth->user_id)->where('product_id', $hearth->product_id)->first();

        if ($heart) {
            // Nếu đã yêu thích, xóa bản ghi
            $heart->delete();
        } else {
            // Nếu chưa yêu thích, tạo mới bản ghi
            $hearth->save();
        }

        return redirect()->route("index");
    }
    public function removehearth($id)
    {
        $heart = Hearths::findOrFail($id);
        $heart->delete();

        return redirect()->route("productshearth");
    }

    public function loadProductHearth()
    {
        $id_user = Session::get('user')->id;
        $hearth = Hearths::where('user_id', $id_user)->get();
        $categories = $this->categories->queryCat();

        return view('Clients/Contents.pdhearth', compact('hearth', 'categories'));
    }
}