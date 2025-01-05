<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use App\Service\FileUploadService;
class CategoryRepository implements CategoryInterface
{
    public function all()
    {
        return Category::latest('id')->get();
    }

    public function allPages($perPage)
    {
        return Category::latest('id')->paginate($perPage);
    }

    public function store($request_data)
    {
        $data = Category::create([
            'name' => $request_data->name,
            'slug' => Str::slug($request_data->name),
            'description' => $request_data->description
        ]);
        $image_path = (new FileUploadService())->imageUpload($request_data, $data, 'image');

        $data->update([
            'image' => $image_path
        ]);
        return $data;
    }

    public function update($request_data, $id)
    {
        $data = $this->show($id);
        $data->update([
            'name' => $request_data->name,
            'slug' => Str::slug($request_data->name),
            'description' => $request_data->description
        ]);
        $image_path = (new FileUploadService())->imageUpload($request_data, $data, 'image');

        $data->update([
            'image' => $image_path
        ]);
        return $data;

    }

    public function delete($id)
    {
        $data = $this->show($id);
        $data->delete();
        return $data;
    }

    public function show($id)
    {
        return Category::findOrfail($id);
    }

    public function status($id)
    {
        $category = $this->show($id);
        $category->is_active = !$category->is_active;
        $category->save();
        return $category;

    }
}
