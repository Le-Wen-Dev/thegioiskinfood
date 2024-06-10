<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Support\Facades\File;

class CategoriesController extends Controller
{
    protected $cate;
    protected $categories;
    public function __construct(Categories $cate)
    {
        $this->cate = $cate;
        $this->categories = new Categories();
    }


    // public function index()
    // {
    //     $categories = Categories::whereNull('category_id')
    //         ->with('childrenCategories')
    //         ->get();
    //     return view('Clients/Contents.categories', compact('categories'));
    // }
    public function searchcate(Request $request)
    {

        $query = $request->input('query');
        $categories = Categories::where('name', 'LIKE', "%$query%")->paginate(5);


        return view('Admins/Categories.searchcate', compact('query', 'categories'));
    }
    public function showcategories()
    {

        $categories = Categories::withCount('products')->orderBy('id', 'desc')->paginate(10);

        return view('Admins/Categories.showcat', compact('categories'));
    }
    public function formstore()
    {
        $categories = $this->categories->queryCat();
        return view('Admins/Categories.addcat', compact('categories'));
    }
    public function storeCategory(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categoriesData = $request->all();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $categoriesData['image'] = $imageName;
        } else {
            $categoriesData['image'] = $categories->image;
        }

        $categories = Categories::create($categoriesData);
        return redirect()->route('admin.showcategories')->with('success');
    }
    public function changeStatusCate(Request $request, $id)
    {
        $category = Categories::find($id);
        if ($category) {
            // Xác định trạng thái mới
            $newStatus = ($category->status == 0) ? 1 : 0;

            // Cập nhật trạng thái của danh mục
            $category->status = $newStatus;

            // Lưu danh mục đã cập nhật
            $category->save();
        }
        return redirect()->back();
    }
    public function formedit($id)
    {
        $cateone = Categories::find($id);
        $categories = $this->categories->queryCat();

        return view('Admins/Categories.editcat', compact('categories', 'cateone'));
    }
    public function editcategory(Request $request, $id)
    {
        $categories = Categories::find($id);
        $categoriesData = $request->all();
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img'), $imageName);
            $categoriesData['image'] = $imageName;
        } else {
            $categoriesData['image'] = $categories->image;
        }

        $categories->fill($categoriesData)->save();

        return redirect()->route("admin.showcategories")->with("success", "");
    }
    public function removecate(Request $request, $id)
    {
        $category = Categories::find($id);
        if ($category) {
            // Đếm số lượng sản phẩm trong danh mục
            $productCount = $category->products()->count();

            // Nếu có sản phẩm trong danh mục
            if ($productCount > 0) {
                // Nếu có sản phẩm trong danh mục, không thực hiện xóa và trả về thông báo
                return redirect()->route("admin.showcategories")->with("error", "Không thể xóa danh mục có chứa sản phẩm!");
            } else {
                // Kiểm tra và xóa hình ảnh liên quan nếu tồn tại
                if ($category->img && file_exists(public_path('img/' . $category->img))) {
                    File::delete(public_path('img/' . $category->img));
                }

                // Xóa danh mục khỏi cơ sở dữ liệu
                $category->delete();

                // Trả về thông báo thành công
                return redirect()->route("admin.showcategories")->with("success", "Danh mục đã được xóa thành công!");
            }
        } else {
            // Nếu không tìm thấy danh mục, trả về thông báo
            return redirect()->route("admin.showcategories")->with("error", "Không tìm thấy danh mục!");
        }
    }
}
