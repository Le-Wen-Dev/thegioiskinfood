<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use App\Models\Bills;


class AdminController extends Controller
{
    protected $pro;
    protected $categories;
    protected $brand;
    public function __construct()
    {
        $this->pro = new Products();
        $this->categories = new Categories();
        $this->brand = new Brands();
    }
    public function index()
    {
        return view("Admins.dashboarh");
    }

    public function category()
    {
        return view('Admins.category');
    }
    public function product()
    {
        $products = $this->pro->handleProductToAdmin();

        return view('Admins/Products.product', compact('products'));
    }
    public function searchproduct(Request $request)
    {

        $query = $request->input('query');
        $products = Products::where('name', 'LIKE', "%$query%")->paginate(5);


        return view('Admins/Products.searchproduct', compact('query', 'products'));
    }
    public function formAddProduct(Request $request)
    {
        $brands = $this->brand->handleBrand();
        $categories = $this->categories->handleCategories();
        return view('Admins/Products.add', compact('categories', 'brands'));
    }
    public function addproduct(Request $request)
    {
        // Validate form input
        $validateData = $request->all();
        // $validateData = $request->validate([
        //     'categories_id' => 'required|string|max:255',
        //     'name' => 'required|string|max:255',
        //     'price' => 'required|numeric|max:255',
        //     'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:255',
        //     'gallery.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:255'
        // ]);

        // Check if the main image was uploaded
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $validateData['img'] = $imageName;
        } else {
            return "Main image not uploaded";
        }

        // Check if gallery images were uploaded
        if ($request->hasFile('gallery')) {
            $imgData = [];

            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('img'), $name);
                $imgData[] = $name;
            }

            // Save gallery image data to the database
            $validateData['gallery'] = json_encode($imgData);
        } else {
            return "Gallery images not uploaded";
        }

        // Create the product
        $product = Products::create($validateData);

        // Assuming $this->pro->handleProductToAdmin() fetches all products, you may want to update it here

        return "Product added successfully";
    }
    // Adjust the namespace as per your Product model location

    public function editproductform(Request $request, int $id)
    {
        $product = Products::findOrFail($id);
        $brands = $this->brand->handleBrand();
        $categories = $this->categories->handleCategories();

        return view('Admins/Products.edit', compact('product', 'categories', 'brands'));
    }
    public function editproduct(Request $request, int $id)
    {
        $validateData = $request->validate([
            'categories_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|max:255',
            'img' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:255',
            'gallery.*' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp,svg|max:255'
        ]);

        // Check if the main image was uploaded
        $mainImageUploaded = false;
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $validateData['img'] = $imageName;
            $mainImageUploaded = true;
        }

        // Check if gallery images were uploaded
        $galleryUploaded = false;
        if ($request->hasFile('gallery')) {
            $imgData = [];

            foreach ($request->file('gallery') as $file) {
                $name = $file->getClientOriginalName();
                $file->move(public_path('img'), $name);
                $imgData[] = $name;
            }

            // Save gallery image data to the database
            $validateData['gallery'] = json_encode($imgData);
            $galleryUploaded = true;
        }



        // Update the product
        $product = Products::findOrFail($id);
        if ($mainImageUploaded || $galleryUploaded) {
            $product->update($validateData);
            return "Product updated successfully";
        } else {
            // Only update other fields if no images were uploaded
            $product->update([
                'categories_id' => $validateData['categories_id'],
                'name' => $validateData['name'],
                'price' => $validateData['price'],
            ]);
            return "Product updated with other fields only";
        }
    }



    public function deleteproduct($id)
    {
        $product = Products::findOrFail($id);

        if ($product) {
            // Xóa tất cả các bản ghi trong bảng carts liên quan đến sản phẩm này
            DB::table('carts')->where('id_product', $id)->delete();
            // Kiểm tra và xóa hình ảnh liên quan nếu tồn tại
            if ($product->img && file_exists(public_path('img/' . $product->img))) {
                File::delete(public_path('img/' . $product->img));
            }



            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $product->delete();
        } else {
            echo "Không tìm thấy bản ghi!";
            return;
        }

        // Lấy danh sách sản phẩm và phân trang để trả về view
        $products = $this->pro->handleProductToAdmin();
        $pagina = Products::paginate(5);

        return view('Admins/Products.product', compact('products', 'pagina'));
    }
    public function followorder()
    {

        $bill = Bills::with('user')->where('status', 1)->get();

        $categories = $this->categories->queryCat();
        return view("Admins.bill", compact('bill', 'categories'));
    }
    public function delivering()
    {
        $bill = Bills::with('user')->where('status', 2)->get();

        $categories = $this->categories->queryCat();
        return view("Admins.bill", compact('bill', 'categories'));
    }
    public function reserved()
    {
        $bill = Bills::with('user')->where('status', 3)->get();

        $categories = $this->categories->queryCat();
        return view("Admins.bill", compact('bill', 'categories'));
    }
    public function canceled()
    {
        $bill = Bills::with('user')->where('status', 4)->get();

        $categories = $this->categories->queryCat();
        return view("Admins.bill", compact('bill', 'categories'));
    }
    public function updateStatus(Request $request, $id)
    {
        $bill = Bills::find($id);
        if ($bill) {
            // Kiểm tra xem trạng thái hiện tại đã đạt đến 3 chưa
            if ($bill->status < 3) {
                // Nếu chưa, thực hiện việc tăng trạng thái lên 1 và lưu lại
                $newStatus = $bill->status + 1;
                $bill->status = $newStatus;
                $bill->save();
            }
        }
        return redirect()->back();
    }
    public function searchbill(Request $request)
    {
        $query = $request->input('query');
        $bill = Bills::where('id_bill', 'LIKE', "%$query%")->paginate(5);


        return view('Admins.searchbill', compact('query', 'bill'));
    }

    public function bill()
    {
        return view('Admins.bill');
    }

    public function user()
    {
        return view('Admins.user');
    }
    public function voucher()
    {
        return view('Admins.voucher');
    }
    public function thongke()
    {
        return view('Admins.thongke');
    }
}
