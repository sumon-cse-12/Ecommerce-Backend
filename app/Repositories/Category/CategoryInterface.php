<?php

namespace App\Repositories\Category;

interface CategoryInterface
{
    public function all();
    public function allPages($perPage);
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function show($id);
    public function status($id);
}
