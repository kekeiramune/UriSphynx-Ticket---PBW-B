<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ (ambil semua data)
    public function index()
    {
<<<<<<< HEAD
        $category = Category::all();
        return view('category', compact('category'));
=======
        $categories = Category::all();
        return view('categories.index', compact('categories'));
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
    }

    // CREATE (simpan data baru)
    public function store(Request $request)
    {
        Category::create($request->only([
            'groupname',
            'type',
            'debut',
            'agency',
            'popular',
            'groupimg',
        ]));

        return redirect()->back();
    }

    // UPDATE (ubah data)
<<<<<<< HEAD
    public function update(Request $request, $idgroup)
    {
        $category = Category::findOrFail($idgroup);
=======
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa

        $category->update($request->only([
            'groupname',
            'type',
            'debut',
            'agency',
            'popular',
            'groupimg',
        ]));

        return redirect()->back();
    }

    // DELETE (hapus data)
<<<<<<< HEAD
    public function destroy($idgroup)
    {
        Category::destroy($idgroup);
=======
    public function destroy($id)
    {
        Category::destroy($id);
>>>>>>> be5e30b4674e3d786da31ab2198c4a1d96e2effa
        return redirect()->back();
    }
}
