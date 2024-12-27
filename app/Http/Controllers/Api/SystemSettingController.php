<?php

namespace App\Http\Controllers\Api;

use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSystemRequest;
use App\Repositories\SystemSettings\SystemSettingsInterface;

class SystemSettingController extends Controller
{
    use ApiResponse;
    private $systemSettingRepository;

    public function __construct(SystemSettingsInterface $systemSettingRepository)
    {
        $this->systemSettingRepository = $systemSettingRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = $this->systemSettingRepository->all();
        if($data){
            return $this->successResponse($data, 'System settings retrieved successfully');
        }else{
            return $this->errorResponse('System settings not found', 404);
        }
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSystemRequest $request, $id)
    {
        try {
            $data = $this->systemSettingRepository->update($request, $id);
            return $this->successResponse($data, 'System settings updated successfully');
        } catch (\Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
