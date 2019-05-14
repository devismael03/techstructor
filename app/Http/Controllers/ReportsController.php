<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instruction;
use App\Report;
use Illuminate\Support\Facades\Auth;

class ReportsController extends Controller
{
    public function store(Request $request){
        $validatedData = $request->validate([
            'description' => 'required',
            'instruction' => 'required',
        ]);
        $instruction = Instruction::find($validatedData['instruction']);
        if($instruction == null || !Auth::check()){
            return back();
        }else{
            $report = new Report();
            $report->instruction()->associate($instruction);
            $report->reporter()->associate(Auth::user());
            $report->description = $validatedData['description'];
            $report->save();
            return back()->with('success','You have added new report successfully');
        }
    }
}
