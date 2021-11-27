<?php

namespace App\Http\Controllers\Api\V2;

use App\CustomerPackage;
use App\Utility\CategoryUtility;
use Auth;
use Illuminate\Http\Request;
use App\User;
use App\Wallet;

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
        $customer_package = CustomerPackage::findOrFail($request->id);
        $user = User::findOrFail(Auth::user()->id);

        if ($customer_package->amount == 0) {
            if ($user->customer_package_id != $customer_package->id) {
                $user->remaining_uploads += $customer_package->product_upload;
                $user->save();
                return response()->json([
                    'success' => true,
                    'message' => translate('Package purchasing successful')
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => translate('You can not purchase this package anymore.')
                ]);
            }
        }

        if($user->balance < $customer_package->amount){
            return response()->json([
                'success' => false,
                'message' => translate('Insufficient wallet balance')
            ]);
        }

        $user->remaining_uploads += $customer_package->product_upload;
        $user->balance = $user->balance - $customer_package->amount;
        $user->customer_package_id = $customer_package->id;

        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = Auth::user()->id;
        $wallet->amount = -$customer_package->amount;
        $wallet->payment_method = 'Wallet';
        $wallet->payment_details = 'Package - '.$customer_package->getTranslation('name');
        $wallet->save();

        return response()->json([
            'success' => true,
            'message' => translate('Package Upgraded')
        ]);

    }


}
