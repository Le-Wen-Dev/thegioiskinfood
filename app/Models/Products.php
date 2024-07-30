<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class Products extends Model
{

    protected $guarded = [];
    use HasFactory;
    // use to client 
    public function productsSale()
    {
        return Products::select('id', 'name', 'description', 'img', 'price', 'sold', 'view')
            ->where('sold', '>=', 30)
            ->orderBy('sold', 'desc')
            ->paginate(5);
    }

    public function productsKhamPha()
    {
        return Products::select('id', 'name', 'description', 'img', 'price', 'sold', 'view')
            ->orderBy('id', 'desc')
            ->paginate(5);
    }
    public function loadByCategory()
    {
        return Products::select('id', 'name', 'description', 'img', 'price', 'sold', 'view')
            ->where('categories_id', '=', 14)
            ->paginate(5);
    }
    public function loadByThuongHieu()
    {
        return Products::select('id', 'name', 'description', 'img', 'price', 'sold', 'view')
            ->where('brand_id', '=', 2)
            ->paginate(5);
    }
    public function productDetail($id)
    {
        return Products::findOrFail($id);
    }
    public function getProByCatWhereId($categories_id)
    {
        return Products::where('categories_id', $categories_id)->paginate(1);
    }

    //use to admin
    public function handleProductToAdmin()
    {
        return Products::select('id', 'name', 'img', 'price', 'warehouse', 'quantity', 'created_at')->orderBy('id', 'desc')
            ->paginate(10);;
    }
}