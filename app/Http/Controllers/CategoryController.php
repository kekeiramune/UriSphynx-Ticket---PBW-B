<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ (ambil semua data)
    public function index()
    {
        $category = Category::all();
        return view('category', compact('category'));
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
    public function update(Request $request, $idgroup)
    {
        $category = Category::findOrFail($idgroup);

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
    public function destroy($idgroup)
    {
        Category::destroy($idgroup);
        return redirect()->back();
    }
}
