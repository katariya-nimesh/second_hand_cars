<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;

class PlanPackageController extends Controller
{
    public function index()
    {
        try {
            $plans = Plan::where('status', 1)->get();

            return ResponseHelper::success($plans, 'Plans retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }
}
