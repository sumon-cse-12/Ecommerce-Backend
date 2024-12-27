<?php
namespace App\Repositories\SystemSettings;


interface SystemSettingsInterface
{
    public function all();
    public function store($data);
    public function update($data, $id);
    public function delete($id);
    public function show($id);  
}
