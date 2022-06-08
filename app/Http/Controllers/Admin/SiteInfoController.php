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

    public function GetSiteInfo()
    {

        $siteinfo = SiteInfo::find(1);
        return view('backend.siteinfo.siteinfo_update', compact('siteinfo'));
    }
}
