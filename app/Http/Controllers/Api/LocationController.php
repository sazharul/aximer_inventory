<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use Illuminate\Http\Request;

class LocationController extends BaseController
{
    public function district()
    {
        $district = District::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return $this->sendResponse($district, 'District retrieved successfully.');
    }

    public function all_area()
    {
        $area = Area::where('status', 1)
            ->orderBy('name', 'asc')
            ->get();

        return $this->sendResponse($area, 'Area retrieved successfully.');
    }

    public function get_area($id)
    {
        $area = Area::where('status', 1)
            ->where('district_id', $id)
            ->orderBy('name', 'asc')
            ->get();

        return $this->sendResponse($area, 'Area retrieved successfully.');
    }
}
