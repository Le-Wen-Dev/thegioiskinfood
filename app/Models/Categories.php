<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function products()
    {
        return $this->hasMany(Products::class, 'categories_id');
    }
    public function queryCat()
    {
        return Categories::whereNull('category_id')
            ->with('childrenCategories')
            ->get();
    }

    public function childrenCategories()
    {
        return $this->hasMany(Categories::class, 'category_id')->with('subCategories');
    }
    public function subCategories()
    {
        return $this->hasMany(Categories::class, 'category_id');
    }




    public function handleCategories()
    {
        return Categories::select('id', 'name')->get();
    }
    public function loadNameCatDynamic($categories_id)
    {
        return Categories::findOrFail($categories_id);
    }
}
