<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\FileCreationRequest;
use App\Http\Requests\FileUpdateRequest;
use App\Models\File;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileController extends Controller
{
    use AuthorizesRequests;
    
    public function store(FileCreationRequest $request)
    {   
         
        $this->authorize('create', File::class);

        $validated = $request->validated();

        $fileUpload = $request->file('file');
        $filter_FileName = $fileUpload->getClientOriginalExtension();
        $filename_Stored = Str::uuid() . '.' . $filter_FileName;
        $path = $fileUpload->storeAs('uploads/'.Auth::id(), $filename_Stored);
        $visibility = (Auth::user()->hasRole('area_manager')|| Auth::user()->hasRole('super_admin')) ? $validated['visibility'] : 1;

        try{
            File::create([
                'original_name' => $fileUpload->getClientOriginalName(),
                'file_name'     => $filename_Stored,
                'file_path'     => $path,
                'mime_type'     => $fileUpload->getMimeType(),
                'size'          => $fileUpload->getSize(),
                'description'   => $validated['description'] ?? null,
                'user_id'       => $validated['user_id'],
                'visibility'    => $visibility
            ]);
        }catch(Exception $e){
            Storage::delete($path);
            throw $e;
        }

        return response()->json([
            'status' => true,
            'message' => 'Upload File '. $fileUpload->getClientOriginalName() . ' Thanh Cong',
           
        ], 200);
    }

    public function update(FileUpdateRequest $request, File $file)
    {
        $this->authorize('update', $file);

        $validated = $request->validated();
        
        $user = Auth::user();
        $data = [];
        $data['description'] = $validated['description'] ?? $file->description;

        if( isset($validated['visibility']) && ($user->can('file.visibility')) ) {
            $data['visibility'] = $validated['visibility'];
        }

        if($request->hasFile('file')){
            $fileUpload = $request->file('file');
            $filename_Stored = Str::uuid(). '.' .$fileUpload->getClientOriginalExtension();
            $newPath = $fileUpload->storeAs('uploads/'. $file->user_id, $filename_Stored);

            if (!$newPath) {
                throw new Exception('Failed to store uploaded file.');
            }
            $oldPath = $file->file_path;

            $data['original_name'] = $fileUpload->getClientOriginalName();
            $data['file_name'] = $filename_Stored;
            $data['file_path'] = $newPath;
            $data['mime_type'] = $fileUpload->getMimeType();
            $data['size'] = $fileUpload->getSize();

            try {
                $file->update($data);
                Storage::delete($oldPath);
            } catch (Exception $e) {
                Storage::delete($newPath);
                throw $e;
            }
        } else {
            $file->update($data);
        }
        
        return response()->json([
            'status' => true,
            'message' => 'Cap Nhat File Thanh Cong'
        ], 200);
    }

    public function destroy(File $file)
    {
        $this->authorize('delete', $file);

        $path = $file->file_path;

        if($file->delete()){
            Storage::delete($path);

            return response()->json([
                'status' => true,
                'message' => 'Xoa File Thanh Cong'
            ], 200);
        }

        return response()->json([
            'status'  => false,
            'message' => 'Xoa File That Bai'
        ], 403);
        
    }
}
