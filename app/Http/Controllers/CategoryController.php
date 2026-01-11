<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // READ (ambil semua data)
    // READ (ambil semua data)
    public function index(Request $request)
    {
        $query = Category::with('latestConcert');

        // Search
        if ($request->filled('search')) {
            $query->where('groupname', 'like', '%' . $request->search . '%');
        }

        // Filter by Type (Tag)
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }

        // Filter by Agency
        if ($request->filled('agency')) {
            $agencies = is_array($request->agency) ? $request->agency : explode(',', $request->agency);
            $query->whereIn('agency', $agencies);
        }

        // Filter by Debut Year
        if ($request->filled('debut_year')) {
            $years = is_array($request->debut_year) ? $request->debut_year : explode(',', $request->debut_year);
            
            $query->where(function($q) use ($years) {
                foreach ($years as $yearRange) {
                    if ($yearRange == 'pre_2010') {
                        $q->orWhere('debut', '1st Gen / pre-2010');
                    } elseif ($yearRange == '2010_2015') {
                        $q->orWhere('debut', '2010-2015');
                    } elseif ($yearRange == '2016_2020') {
                        $q->orWhere('debut', '2016-2020');
                    } elseif ($yearRange == '2021_plus') {
                        $q->orWhere('debut', '2021-present');
                    }
                }
            });
        }

        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'popular':
                    // ENUM order: 1:mostp, 2:trend, 3:new. ASC puts mostp first.
                    $query->orderBy('popular', 'asc');
                    break;
                case 'newest': // Newly Added
                    $query->orderBy('idgroup', 'desc');
                    break;
                case 'trending': 
                     // Fallback for trending: prioritize 'trend' (index 2)
                     // If we just want strict 'trend' items first, we might filter. 
                     // But for simple sort on mixed list:
                    $query->orderBy('popular', 'asc');
                    break;
                default:
                    $query->orderBy('groupname', 'asc');
            }
        } else {
            $query->orderBy('groupname', 'asc');
        }

        $category = $query->get();
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