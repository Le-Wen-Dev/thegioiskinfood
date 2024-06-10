<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Users;

class UsersController extends Controller
{
    //
    public function showuser()
    {
        $user = Users::orderBy("id", "desc")->paginate(10);
        return view("Admins/Users.showuser", compact("user"));
    }
    public function searchuser(Request $request)
    {

        $query = $request->input('query');
        $user = Users::where('name', 'LIKE', "%$query%")->paginate(5);


        return view('Admins/Users.searchuser', compact('query', 'user'));
    }
    public function formstoreuser()
    {

        return view("Admins/Users.adduser");
    }
    public function storeuser(Request $request)
    {

        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $userData['img'] = $imageName;
        }
        $user = Users::create($userData);
        return redirect()->route('admin.user')->with('success');
    }
    public function formedituser(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        return view('Admins/Users.edituser', compact('user'));
    }
    public function edituser(Request $request, $id)
    {
        $user = Users::findOrFail($id);
        $userData = $request->all();
        $userData['password'] = Hash::make($request->password);
        if ($request->hasFile('img')) {
            $imageName = time() . '.' . $request->img->extension();
            $request->img->move(public_path('img'), $imageName);
            $userData['img'] = $imageName;
        }
        $user->fill($userData)->save();
        return redirect()->route('admin.user')->with('success');
    }
    public function deleteuser(Request $request, $id)
    {
        $user = Users::find($id);

        if (!$user) {
            echo "Không tìm thấy bản ghi!";
            return;
        }

        // Kiểm tra trạng thái của người dùng
        if ($user->status == 1) {
            return redirect()->route("admin.user")->with("error", "Không thể xóa người dùng quản trị!");
        } else {
            if ($user->img && file_exists(public_path('img/' . $user->img))) {
                File::delete(public_path('img/' . $user->img));
            }
        }

        // Nếu người dùng không phải là quản trị và tồn tại



        return redirect()->route("admin.user")->with("success", "Người dùng đã được xóa thành công!");
    }
}
