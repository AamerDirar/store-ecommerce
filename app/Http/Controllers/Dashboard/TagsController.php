<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\TagRequest;
use App\Models\Tag;
use DB;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::orderBy('id', 'DESC')->paginate(PAGINATION_COUNT);
        return view('dashboard.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('dashboard.tags.create');
    }

    public function store(TagRequest $request)
    {
        try {
            DB::beginTransaction();
            $tag = Tag::create($request->except('_token'));
            // save translations
            $tag->name = $request->name;
            $tag->save();
            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم الإضافة بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function edit($id)
    {
        $tag = Tag::orderBy('id', 'DESC')->find($id);
        if (!$tag)
            return redirect()->route('admin.tags')->with(['error' => 'هذا الوسم غير موجود']);
        return view('dashboard.tags.edit', compact('tag'));
    }

    public function update(TagRequest $request, $id)
    {
        try {
            $tag = Tag::find($id);
            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا الوسم غير موجود']);

            DB::beginTransaction();

            $tag->update($request->except('_token', 'id'));  // update only for slug column

            // save translations
            $tag->name = $request->name;
            $tag->save();

            DB::commit();
            return redirect()->route('admin.tags')->with(['success' => 'تم التحديث بنجاح']);
        } catch (\Exception $ex) {
            DB::rollback();
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }

    public function destroy($id)
    {
        try {
            $tag = Tag::find($id);

            if (!$tag)
                return redirect()->route('admin.tags')->with(['error' => 'هذا الوسم غير موجود']);

            $tag->delete();

            return redirect()->route('admin.tags')->with(['success' => 'تم الحذف بنجاح']);
        } catch (\Exception $ex) {
            return redirect()->route('admin.tags')->with(['error' => 'حدث خطأ ما برجاء المحاولة لاحقاً']);
        }
    }
}
