<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ (ambil semua data)
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // CREATE (simpan data baru)
    public function store(Request $request)
    {
        Category::create($request->only([
            'groupname',
            'type',
            'debut',
            'agency',
            'popular'
        ]));

        return redirect()->back();
    }

    // UPDATE (ubah data)
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $category->update($request->only([
            'groupname',
            'type',
            'debut',
            'agency',
            'popular'
        ]));

        return redirect()->back();
    }

    // DELETE (hapus data)
    public function destroy($id)
    {
        Category::destroy($id);
        return redirect()->back();
    }
}
