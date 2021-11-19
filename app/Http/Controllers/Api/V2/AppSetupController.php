<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Resources\V2\AppSetupCollection;
use App\Models\AppSetup;

class AppSetupController extends Controller
{
    public function index()
    {
        return new AppSetupCollection(AppSetup::all());
    }
}
