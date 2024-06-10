<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;


Route::prefix('/')->group(function () {
    Route::get('/', [ProductsController::class, 'index']);
    Route::get('/detail/{id}', [ProductsController::class, 'getDetail']);
    Route::get('/cart', [CartController::class, 'index']);
    Route::get('/search', [ProductsController::class, 'search'])->name('search');
    Route::get('/productbycategory', [ProductsController::class, 'proByCategory']);
    Route::get('/catlv1', [ProductsController::class, 'categorylv1']);
    Route::get('/categories/{category_id}', [ProductsController::class, 'categorylv3'])->name('categories');
});
Route::prefix('')->group(function () {
    Route::get('/index', [AuthController::class, 'index'])->name('index');
    Route::get('/formregis', [AuthController::class, 'formregister']);
    Route::get('/formlogin', [AuthController::class, 'formLogin'])->name('formlogin');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
});

Route::group(['middleware' => 'auth.user'], function () {
    Route::prefix('/')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart');
        Route::post('/addtocart', [CartController::class, 'addToCart']);
        Route::post('/decreasecart', [CartController::class, 'decreaseCart'])->name('decrease.cart');
        Route::post('/increasecart', [CartController::class, 'increaseCart'])->name('increase.cart');
        Route::post('/removecart', [CartController::class, 'removeCart'])->name('remove.cart');
        Route::post('/removeallcart', [CartController::class, 'removeallCart'])->name('removeallcart');
        //bill
        Route::get('/bill', [BillController::class, 'index']);
        Route::post('/createbill', [BillController::class, 'createBill']);
        Route::post('/calculate-total', [BillController::class, 'calculateTotal']);
        Route::get('/bill/{id}', [BillController::class, 'showBill'])->name('bill.show');
        Route::get('/showbillss', [BillController::class, 'showTempBill'])->name('showbillss');
        Route::post('/bill/complete', [BillController::class, 'completeBill'])->name('bill.complete');
        // san pham yeu thich
        Route::post('/pdhearth', [ProductsController::class, 'productHearth'])->name('pdhearth');
        Route::get('/productshearth', [ProductsController::class, 'loadProductHearth'])->name('productshearth');
        Route::get('/removehearth/{id}', [ProductsController::class, 'removehearth'])->name('removehearth');
        // infor user
        Route::get('/inforuser', [AuthController::class, 'inforuser'])->name('inforuser');
        Route::post('/updateuser', [AuthController::class, 'updateuser'])->name('updateuser');
        // follow ordered
        Route::get('/followorder', [AuthController::class, 'followorder'])->name('followorder'); // hiển thị luôn đơn hàng đang đợi xác nhận (waitcomfirm)
        Route::get('/delivering', [AuthController::class, 'delivering'])->name('delivering');
        Route::get('/reserved', [AuthController::class, 'reserved'])->name('reserved');
        Route::get('/canceled', [AuthController::class, 'canceled'])->name('canceled');
        Route::post('/cancelorder/{id}', [AuthController::class, 'cancelorder'])->name('cancelorder'); // hiển thị luôn đơn hàng đang đợi xác nhận (waitcomfirm)

    });
});
Route::prefix('/admin')->middleware('checkRole')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/shocat', [AdminController::class, 'category'])->name('admin.category');
    //bill
    Route::get('/showbill', [AdminController::class, 'followorder'])->name('admin.bill');
    Route::post('/update-status/{id}', [AdminController::class, 'updateStatus'])->name('updateStatus');
    Route::get('/delivering', [AdminController::class, 'delivering'])->name('admin.delivering');
    Route::get('/reserved', [AdminController::class, 'reserved'])->name('admin.reserved');
    Route::get('/canceled', [AdminController::class, 'canceled'])->name('admin.canceled');
    Route::get('/searchbill', [AdminController::class, 'searchbill'])->name('admin.searchbill');
    // category
    Route::get('showcategories', [CategoriesController::class, 'showcategories'])->name('admin.showcategories');
    Route::get('storecategories', [CategoriesController::class, 'formstore'])->name('admin.storecategories');
    Route::post('storecategories', [CategoriesController::class, 'storeCategory'])->name('admin.storecategories');
    Route::post('changeStatusCate/{id}', [CategoriesController::class, 'changeStatusCate'])->name('admin.changeStatusCate');
    Route::get('editcategory/{id}', [CategoriesController::class, 'formedit'])->name('admin.formeditcategory');
    Route::post('editcategory/{id}', [CategoriesController::class, 'editcategory'])->name('admin.editcategory');
    Route::get('removecategory/{id}', [CategoriesController::class, 'removecate'])->name('admin.removecategory');
    Route::get('searchcate', [CategoriesController::class, 'searchcate'])->name('admin.searchcate');
    // user
    Route::get('/user', [UsersController::class, 'showuser'])->name('admin.user');
    Route::get('/formstoreuser', [UsersController::class, 'formstoreuser'])->name('admin.formstoreuser');
    Route::post('/storeuser', [UsersController::class, 'storeuser'])->name('admin.storeuser');
    Route::get('/edituser/{id}', [UsersController::class, 'formedituser'])->name('admin.formedituser');
    Route::post('/edituser/{id}', [UsersController::class, 'edituser'])->name('admin.edituser');
    Route::get('/deleteuser/{id}', [UsersController::class, 'deleteuser'])->name('admin.deleteuser');
    Route::get('/searchuser}', [UsersController::class, 'searchuser'])->name('admin.searchuser');

    //view admin
    //  Route::get('/user', [AdminController::class, 'user'])->name('admin.user');
    Route::get('/voucher', [AdminController::class, 'voucher'])->name('admin.voucher');
    Route::get('/thongke', [AdminController::class, 'thongke'])->name('admin.thongke');
    // order bill
});
Route::prefix('/admin/product')->middleware('checkRole')->group(function () {
    Route::get('/showproduct', [AdminController::class, 'product'])->name('admin.products.showproduct');
    Route::get('/addproduct', [AdminController::class, 'formAddProduct']);
    Route::post('/store', [AdminController::class, 'addproduct'])->name('store');
    Route::get('/delete/{id}', [AdminController::class, 'deleteproduct'])->name('delete');
    Route::get('/edit/{id}', [AdminController::class, 'editproductform'])->name('edit');
    Route::post('/edit/{id}', [AdminController::class, 'editproduct'])->name('edit');
    Route::get('/searchproduct', [AdminController::class, 'searchproduct'])->name('admin.searchproduct');
});
