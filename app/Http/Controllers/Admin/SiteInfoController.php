<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteInfo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteInfoController extends Controller
{
    //
    public function AllSiteInfo()
    {
        $result = SiteInfo::get();
        return $result;
    }
}
