<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\MainCategoryRequest;
use App\Models\Category;
use DB;

class MainCategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::parent()->orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('dashboard.categories.create');
    }

    public function store(MainCategoryRequest $request)
    {
        try {

            DB::beginTransaction();

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);


            $category = Category::create($request->except('_token'));

            // save translations
            $category->name = $request->name;
            $category->save();
            DB::commit();
            return redirect()->route('admin.maincategories')->with(['success' => 'تم الإضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function edit($id)
    {
        $category = Category::orderBy('id', 'DESC')->find($id);

        if (!$category)
            return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);

        return view('dashboard.categories.edit', compact('category'));
    }

    public function update(MainCategoryRequest $request, $id)
    {
        try {

            $category = Category::find($id);

            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);

            if (!$request->has('is_active'))
                $request->request->add(['is_active' => 0]);
            else
                $request->request->add(['is_active' => 1]);

            $category->update($request->all());

            // save translations
            $category->name = $request->name;
            $category->save();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {

            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function destroy($id)
    {
        try {
            $category = Category::orderBy('id', 'DESC')->find($id);

            if (!$category)
                return redirect()->route('admin.maincategories')->with(['error' => 'هذا القسم غير موجود']);

            $category->delete();

            return redirect()->route('admin.maincategories')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.maincategories')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }
}
