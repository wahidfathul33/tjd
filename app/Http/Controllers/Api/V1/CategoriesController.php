<?php

namespace App\Http\Controllers\Api\V1;

use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Validator;

class CategoriesController extends Controller
{
    Use ApiResponser;

    public function index()
    {
        $category = Category::getThree();

        if($category->isEmpty()){
            abort(404, "not found");
        }

        return $this->success(
            ['category' => $category],  'Record successfully retrieved'
        );
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required|string|max:255',
            'slug'  => 'unique:categories,slug'
        ]);

        if($validator->fails()){
            return $this->error('The given data was invalid', 400, $validator->errors());
        }

        $category = Category::create($request->all());

        return $this->success(
            ['category' => $category],
            'Record successfully saved', 201
        );
    }

    public function show(Category $category)
    {
        return $this->success(
            ['category' => $category],
            'Record successfully retrieved'
        );
    }

    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(),[
            'name'  => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return $this->error('The given data was invalid', 400, $validator->errors());
        }

        $category = $category->update($request->all());

        return $this->success(
            null,
            'Record successfully updated'
        );
    }

    public function destroy(Category $category)
    {
        $category = $category->delete();

        return $this->success(
            null,
            'Record successfully deleted'
        );
    }
}
