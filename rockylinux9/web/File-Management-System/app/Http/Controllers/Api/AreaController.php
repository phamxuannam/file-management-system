<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AreaRequest;
use App\Http\Resources\AreaResource;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
  
    public function index()
    {
        $areas = Area::latest()->get();

        return response()->json([
            'status' => true,
            'message' => 'Danh Sach Areas.',
            'data' => AreaResource::collection($areas) 
        ], 200);
    }

    public function store(AreaRequest $request)
    {
        $validated = $request->validated();
        $area = Area::create($validated);

        return response()->json([
            'status' => true,
            'message' => 'Tao Area Thanh Cong',
            'data'  => new AreaResource($area)
        ], 201);
    }

    public function show(string $id)
    {
        $area = Area::find($id);

        if(!$area){
            return response()->json([
                'status' => false,
                'message' => 'Area Khong Ton Tai',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Hien Thi Area',
            'data'  => $area
        ], 200);
    }

    public function update(AreaRequest $request, string $id)
    {   
        $area = Area::find($id);

        if(!$area){
            return response()->json([
                'status' => false,
                'message' => 'Khong Tim Thay Area.',
                'data' => null
            ], 404);  
        }

        $validated = $request->validated();
        $areaUpdate = $area->update($validated);
        
        return response()->json([
            'status' => true,
            'data' => $areaUpdate
        ], 200);
    }

    public function destroy(string $id)
    {
        $area = Area::find($id);

        if(!$area){
            return response()->json([
                'status' => false,
                'message' => 'Khong Tim Thay Area.',
                'data' => null
            ], 404);  
        }

        $area->delete();

        return response()->json([
            'status' => true,
            'message' => 'Xoa Thanh Cong'
        ], 200);
    }
}
