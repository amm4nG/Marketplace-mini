<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\SlideDataTable;
use App\Http\Controllers\Controller;
use App\Models\Slide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SlideController extends Controller
{
    public function index(SlideDataTable $dataTable)
    {
        return $dataTable->render('seller.slides.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_new' => 'required',
            'url_image_new' => ['required', 'image'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $path = $request->file('url_image_new')->store('slides', 'public');
            Slide::create([
                'order' => $request->order_new,
                'url_image' => $path,
            ]);
            return response()->json([
                'message' => 'Add new slide successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $slide = Slide::findorFail($id);
            if ($slide->url_image) {
                Storage::disk('public')->delete($slide->url_image);
            }
            $slide->delete();
            return back()->with([
                'message' => 'Deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'order' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }
        try {
            $slide = Slide::findOrFail($id);
            $file = $request->file('url_image');
            if ($file) {
                if ($slide->url_image) {
                    Storage::disk('public')->delete($slide->url_image);
                }
                $path = $file->store('slides', 'public');
                $slide->url_image = $path;
            }
            $slide->order = $request->order;
            $slide->update();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'errors' => $th->getMessage(),
            ]);
        }
    }
}
