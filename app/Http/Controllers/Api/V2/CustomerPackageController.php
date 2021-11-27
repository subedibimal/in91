<?php

namespace App\Http\Controllers\Api\V2;

use App\CustomerPackage;
use App\Utility\CategoryUtility;
use Auth;
use Illuminate\Http\Request;

class CustomerPackageController extends Controller
{
    public function index()
    {
        return CustomerPackage::with(['logo'=>function($query){
                 $query->select('id','file_name');
                  }])->get();
    }

    public function purchase(Request $request)
    {

    }


}
