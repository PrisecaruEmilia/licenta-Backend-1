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

    public function UpdateSiteInfo(Request $request)
    {

        $siteinfo_id = $request->id;

        SiteInfo::findOrFail($siteinfo_id)->update([
            'about' => $request->about,
            'refund' => $request->refund,
            'purchase_guide' => $request->purchase_guide,
            'privacy' => $request->privacy,
            'address' => $request->address,
            'android_app_link' => $request->android_app_link,
            'ios_app_link' => $request->ios_app_link,
            'facebook_link' => $request->facebook_link,
            'twiter_link' => $request->twiter_link,
            'instagram_link' => $request->instagram_link,
            'copyright_text' => $request->copyright_text,

        ]);


        $notification = array(
            'message' => 'SiteInfo Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
