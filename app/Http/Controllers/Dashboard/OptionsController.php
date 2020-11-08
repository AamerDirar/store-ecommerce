<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\OptionsRequest;
use App\Models\Attribute;
use App\Models\Option;
use App\Models\Product;
use DB;

class OptionsController extends Controller
{
    public function index()
    {
        $options = Option::with(['product' => function($prod) {
            $prod->select('id');
        },
        'attribute' => function($attr) {
            $attr->select('id');
        }])->select('id', 'product_id', 'attribute_id', 'price')->paginate(PAGINATION_COUNT);
        return view('dashboard.options.index', compact('options'));
    }

    public function create()
    {
        $data               = [];
        $data['products']   = Product::active()->select('id')->get();
        $data['attributes'] = Attribute::select('id')->get();
        return view('dashboard.options.create', $data);
    }

    public function store(OptionsRequest $request)
    {
        try {

            DB::beginTransaction();

            $option = Option::create([
                'attribute_id'      =>  $request->attribute_id,
                'product_id'        =>  $request->product_id,
                'price'             =>  $request->price,
            ]);

            // save translations
            $option->name = $request->name;
            $option->save();
            DB::commit();
            return redirect()->route('admin.options')->with(['success' => 'تم الإضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.options')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function edit($id)
    {
        $attribute = Attribute::orderBy('id', 'DESC')->find($id);

        if (!$attribute)
            return redirect()->route('admin.attributes')->with(['error' => 'هذه الخاصية غير موجودة']);

        return view('dashboard.attributes.edit', compact('attribute'));
    }

    public function update(OptionsRequest $request, $id)
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
