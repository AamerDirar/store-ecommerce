<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeRequest;
use App\Models\Attribute;
use DB;

class AttributesController extends Controller
{
    public function index()
    {
        $attributes = Attribute::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.attributes.index', compact('attributes'));
    }

    public function create()
    {
        return view('dashboard.attributes.create');
    }

    public function store(AttributeRequest $request)
    {
        try {

            DB::beginTransaction();

            $attribute = Attribute::create($request->except('_token'));

            // save translations
            $attribute->name = $request->name;
            $attribute->save();
            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم الإضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.attributes')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function edit($id)
    {
        $attribute = Attribute::orderBy('id', 'DESC')->find($id);

        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير موجودة']);

        return view('dashboard.attributes.edit', compact('attribute'));
    }

    public function update(AttributeRequest $request, $id)
    {
        try {

            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير موجودة']);

            DB::beginTransaction();

            $attribute->update($request->except('_token', 'id'));

            // save translations
            $attribute->name = $request->name;
            $attribute->save();

            DB::commit();
            return redirect()->route('admin.attributes')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.attribute')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function destroy($id)
    {
        try {
            $attribute = Attribute::find($id);

            if (!$attribute)
                return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير موجودة']);

            $attribute->delete();

            return redirect()->route('admin.attributes')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.attributes')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }
}
