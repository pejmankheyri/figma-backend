<?php

namespace App\Http\Controllers;

use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $teams = Brand::orderBy('id', 'desc')->paginate(10);
        return BrandResource::collection($teams);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:40']
        ]);

        $brand = Brand::create([
            'name' => $request->name,
        ]);

        return new BrandResource($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:40'],
        ]);

        $brand = Brand::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'brand updated successfully!'], 200);
    }

    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);

        $brand->delete();

        return response()->json(['message' => 'brand deleted successfully!'], 200);
    }
}
