<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    public function index()
    {
        $plans = Plan::all();
        return view('admin.plan.index', compact('plans'));
    }

    public function create()
    {
        return view('admin.plan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|unique:plans,name',
            'totalcars' => 'required|integer|min:0',
            'price'     => 'required|integer|min:0',
        ]);

        Plan::create([
            'name'      => $request->name,
            'total_cars'     => $request->totalcars,
            'price'     => $request->price,
        ]);

        return redirect()->route('manage-plans')->with('success', 'Plan created successfully.');
    }

    public function edit($id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.edit', compact('plan'));
    }

    public function details($id)
    {
        $plan = Plan::find($id);
        return view('admin.plan.details', compact('plan'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|unique:plans,name,' . $request->id,
            'totalcars' => 'required|integer|min:0',
            'price'     => 'required|integer|min:0',
        ]);

        $plan = Plan::find($request->id);
        $plan->fill($request->all());

        $plan->save();

        return redirect()->route('manage-plans')->with('success', 'Plan updated successfully.');
    }

    public function destroy($id)
    {
        $plan = Plan::find($id);
        $plan->delete();

        return redirect()->route('manage-plans')->with('success', 'Plan deleted successfully.');
    }

    public function changeStatus(Request $request){
        $plan = Plan::find($request->id);
        $plan->status = $request->status;
        $plan->update();

        return response()->json(["message" => "Plan status updated successfully !"]);
    }
}
