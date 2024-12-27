<?php
namespace App\Repositories\SystemSettings;

use App\Models\SystemSetting;

class SystemSettingsRepository implements SystemSettingsInterface
{
    public function store($request_data)
    {
        $data =  SystemSetting::create([
            'site_name' => $request_data->site_name,
            "site_logo" => $request_data->site_logo,
            "site_favicon" => $request_data->site_favicon,
            'site_phone' => $request_data->site_phone,
            'site_email' => $request_data->site_email,
            "site_facebook_link" => $request_data->site_facebook_link,
            "meta_keywords" => $request_data->meta_keywords,
            "meta_description" => $request_data->meta_description
        ]);

        return $this->show($data->id);
    }

    /*
    * @retun mixed|void
    */

    public function all()
    {
        $data = SystemSetting::firstOrFail();
        return $data;
    }

    /*
    * @retun mixed|void
    */

    public function show($id)
    {
        $data = SystemSetting::findOrFail($id);
        return $data;
    }

    /*
    * @param $data
    * @return mixed|void
    */

    public function update($request_data, $id)
    {
        $data = SystemSetting::findOrFail($id);
        $data->update([
            'site_name' => $request_data->site_name,
            "site_logo" => $request_data->site_logo,
            "site_favicon" => $request_data->site_favicon,
            'site_phone' => $request_data->site_phone,
            'site_email' => $request_data->site_email,
            "site_facebook_link" => $request_data->site_facebook_link,
            "meta_keywords" => $request_data->meta_keywords,
            "meta_description" => $request_data->meta_description
        ]);

        return $data;
    }

    /*
    * @retun mixed|void
    */

    public function delete($id)
    {
        $data = $this->show($id);
        $data->delete();
        return true;
    }
}

