<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\InstrumentImageDataTable;
use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\InstrumentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InstrumentImageController extends Controller
{
    public function show(InstrumentImageDataTable $dataTable, $id)
    {
        $instrument = Instrument::findOrFail($id);
        $dataTable->setInstrument($id);
        return $dataTable->render('seller.instruments.images.show', compact('instrument'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image_new' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            ],
            [
                'image_new.required' => 'Please choose your instrument image',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $image = new InstrumentImage();
            $file = $request->file('image_new');
            $path = $file->store('images', 'public');
            $image->instrument_id = $request->instrument_id;
            $image->image = $path;
            $image->save();
            return response()->json([
                'status' => 200,
                'message' => 'Add image successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image' => ['required', 'image', 'mimes:jpeg,png,jpg'],
            ],
            [
                'image.required' => 'Please choose your instrument image',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $image = InstrumentImage::findOrFail($id);
            Storage::disk('public')->delete($image->image);
            $path = $request->file('image')->store('images', 'public');
            $image->image = $path;
            $image->update();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        try {
            $image = InstrumentImage::findOrFail($id);
            Storage::disk('public')->delete($image->image);
            $image->delete();
            return back()->with([
                'message' => 'Deleted successfully',
            ]);
        } catch (\Throwable $th) {
            return back()->with([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
