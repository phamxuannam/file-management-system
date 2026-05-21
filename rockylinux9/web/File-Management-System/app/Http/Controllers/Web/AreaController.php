<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Models\Area;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AreaController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $this->authorize('viewAny', Area::class);

        $areas = Area::latest()->paginate(10);
        return view('areas.list', [
            'areas' => $areas
        ]);
    }

    public function fetchArea(){
        $areas = Area::latest()->paginate(10);

        return view('areas.load-data',[
            'areas' => $areas
        ])->render();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Area::class);

        return view('areas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AreaRequest $request)
    {
        $this->authorize('create', Area::class);

        $validated = $request -> validated();
        Area::create($validated);

        return response()->json([
            'status'  => true,
            'message' => 'Tao Area Thanh Cong.'
        ]);
    }
//->route('areas.index')
    /**
     * Display the specified resource.
     */
    public function show(string $id){}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Area $area)
    {
        $this->authorize('update', $area);

        return response()->json([
            'status' => true,
            'data'   => $area
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AreaRequest $request, Area $area)
    {
        $this->authorize('update', $area);

        $validated = $request->validated();
        $area->update($validated);
        
        return response()->json([
            'status'  => true,
            'message' => 'Cap Nhat Area '. $area->name .' Thanh Cong' 
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Area $area)
    {
        $this->authorize('delete', $area);

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
