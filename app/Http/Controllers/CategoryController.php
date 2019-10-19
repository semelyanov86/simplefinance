<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryCreateRequest;
use App\Category;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function create(CategoryCreateRequest $request)
    {
        $category = new Category();
        $category->category_name = $request->category_name;
        $category->sys_category_id = $request->sys_category_id;
        $category->category_type = $request->category_type;
        $category->isHidden = $request->isHidden;
        if ($request->parent_id) {
            $category->parent_id = $request->parent_id;
        }
        $category->save();
        $category->message = 'Category added successfully';
        return $category;
    }

    public function destroy(int $id)
    {
        if (Auth::user() && Auth::user()->hasPermissionTo('manage categories')) {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                'message' => 'Category has been deleted',
            ]);
        } else {
            abort(403, 'You are not authorized to do this action');
        }
    }
}
