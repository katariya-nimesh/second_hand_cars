<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Plan;
use App\Models\CouponCode;
use Carbon\Carbon;

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

    public function purchasePlan(Request $request)
    {
        try {
            $request->validate([
                'plan_id' => 'required|exists:plans,id',
            ]);

            // check the new plan or upgrade the plan
            $user = Auth::user();

            if($user->plan_id){
                // check the choosen plan is greater than the exists plan
                $plan = Plan::find($request->plan_id);

                $currentPlanTotalCars = $user->plan->total_cars;
                $choosenPlanTotalCars = $plan->total_cars;

                if($currentPlanTotalCars < $choosenPlanTotalCars){
                    $user->update([
                        'plan_id' => $request->plan_id,
                        // 'plan_start_date' => Carbon::now(),
                        // 'plan_end_date' => Carbon::now()->addMonth()
                    ]);

                    return ResponseHelper::success(null, 'Plans upgrade successfully');
                }else{
                    return ResponseHelper::success(null, 'Plans not be upgraded');
                }
            }else{
                $user->update([
                    'plan_id' => $request->plan_id,
                    'plan_start_date' => Carbon::now(),
                    'plan_end_date' => Carbon::now()->addMonth()
                ]);
            }

            return ResponseHelper::success(null, 'Plans added successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function checkCoupon($code)
    {
        try {

            $couponCode = CouponCode::where('code', $code)->first();

            if($couponCode){
                return ResponseHelper::success($couponCode, 'Coupon match! discount applied');
            }

            return ResponseHelper::success(null, 'Coupon does not match');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }

    }
}
