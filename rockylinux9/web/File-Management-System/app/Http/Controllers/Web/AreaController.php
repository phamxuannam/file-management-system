<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::latest()->paginate(10);
        return view('areas.list', [
            'areas' => $areas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request -> validated();
        Area::create($validated);

        return redirect()->route('areas.index')->with('success', 'Tao Area Thanh Cong');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        return view('areas.edit', [
            'area' => $area
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaRequest $request, Area $area)
    {
        $validated = $request->validated();
        $area->update($validated);
        
        return redirect()->route('areas.index')->with('success', 'Cap Nhat Area Thanh Cong');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        if($area->delete()){
            return response()->json([
                'status' => true,
                'message' => 'Xoa Area Thanh Cong'
            ]);
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Loi, Khong The Xoa Area'
        ]);
      
    }
}
