<?php

namespace App\Http\Controllers;

use App\Http\Resources\ModelResource;
use App\Models\Brand;
use App\Models\Cmodel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmodelController extends Controller
{
    public function index($id)
    {
        $brand = Brand::findOrFail($id);

        $models = Cmodel::where('brand_id', $id)->get();

        return ModelResource::collection($models);
    }

    public function store(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:40']
        ]);

        $model = Cmodel::create([
            'brand_id' => $id,
            'name' => $request->name,
        ]);

        return new ModelResource($model);
    }

    public function update(Request $request, $id)
    {
        $model = Cmodel::findOrFail($id);

        $this->validate($request, [
            'name' => ['required', 'string', 'max:40'],
        ]);

        $model = Cmodel::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return response()->json(['message' => 'model updated successfully!'], 200);
    }

    public function destroy($id)
    {
        $model = Cmodel::findOrFail($id);

        $model->delete();

        return response()->json(['message' => 'model deleted successfully!'], 200);
    }

    public function search(Request $request)
    {
        $search = Brand::select(
            "brands.id",
            "brands.name",
        )
            ->leftJoin("cmodels", "cmodels.brand_id", "=", "brands.id")
            ->where('brands.name', 'like', '%' . $request->s . '%')
            ->orWhere('cmodels.name', 'like', '%' . $request->s . '%')
            ->groupBy('brands.id')
            ->get();

        return $search;
    }
}
