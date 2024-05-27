<?php

namespace App\Http\Controllers\Seller;

use App\DataTables\Seller\InstrumentDataTable;
use App\Http\Controllers\Controller;
use App\Models\Instrument;
use App\Models\InstrumentImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InstrumentController extends Controller
{
    public function index(InstrumentDataTable $dataTable)
    {
        return $dataTable->render('seller.instruments.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name_instrument_new' => 'required',
                'category_id_new' => 'required',
                'stock_new' => 'required',
                'price_new' => ['required', 'numeric', 'min:0', 'regex:/^\d{1,15}(\.\d{1,2})?$/'],
                'description_new' => 'nullable',
                'images_new' => 'required',
                'images_new.*' => 'image|mimes:jpeg,png,jpg',
            ],
            [
                'name_instrument_new.required' => 'The name instrument field is required',
                'category_id_new.required' => 'Please selec   t category instrument',
                'stock_new.required' => 'The stock field is required',
                'price_new.required' => 'The price field is required',
                'images_new.required' => 'Please choose your instrument image',
                'price_new.regex' => 'The price must be a number with up to 15 digits',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        DB::beginTransaction();
        try {
            $instrument = new Instrument();
            $instrument->user_id = Auth::user()->id;
            $instrument->category_id = $request->category_id_new;
            $instrument->name_instrument = $request->name_instrument_new;
            $instrument->stock = $request->stock_new;
            $instrument->price = $request->price_new;
            $instrument->description = $request->description_new;
            $instrument->save();

            $files = $request->file('images_new');
            foreach ($files as $file) {
                $image = new InstrumentImage();
                $image->instrument_id = $instrument->id;
                $filePath = $file->store('images', 'public');
                $image->image = $filePath;
                $image->save();
            }
            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => 'Add new instrument successfully',
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'status' => 500,
                'message' => $th->getMessage(),
            ]);
        }
    }

    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $instrument = Instrument::findOrFail($id);
            $images = $instrument->instrumentImages;

            $pathImages = [];
            if ($images) {
                foreach ($images as $image) {
                    $pathImages[] = $image->image;
                    $image->delete();
                }
            }

            $instrument->delete();
            DB::commit();

            foreach ($pathImages as $image) {
                Storage::disk('public')->delete($image);
            }

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
        $validator = Validator::make(
            $request->all(),
            [
                'name_instrument' => 'required',
                'category_id' => 'required',
                'stock' => 'required',
                'price' => ['required', 'numeric', 'min:0', 'regex:/^\d{1,15}(\.\d{1,2})?$/'],
                'description' => 'nullable',
            ],
            [
                'category_id.required' => 'Please selec t category instrument',
                'price-.regex' => 'The price must be a number with up to 15 digits',
            ],
        );

        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->errors(),
            ]);
        }

        try {
            $instrument = Instrument::findOrFail($id);
            $instrument->name_instrument = $request->name_instrument;
            $instrument->category_id = $request->category_id;
            $instrument->stock = $request->stock;
            $instrument->price = $request->price;
            $instrument->description = $request->description;
            $instrument->save();
            return response()->json([
                'status' => 200,
                'message' => 'Updated successfully',
            ]);
        } catch (\Throwable $th) {
            return back()->withErrors([
                'message' => $th->getMessage(),
            ]);
        }
    }
}
