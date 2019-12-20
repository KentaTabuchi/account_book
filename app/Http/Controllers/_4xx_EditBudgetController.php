<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\SQL\_401_SQL;


/*
|--------------------------------------------------------------------------
| 入力画面のコントローラー
|--------------------------------------------------------------------------
*/
class _4xx_EditBudgetController extends Controller
{
    public function edit_budget_get(Request $request){
        return view('401_edit_budget');
    }
    public function edit_budget_post(Request $request){
        $year = 2019;
        $month = 1;
        $user_id = 1;
        $budget = 1000;
        _401_SQL::insert_budget($year,$month,$budget,$user_id);
        $budget = 2000;
        _401_SQL::update_budget($year,$month,$budget,$user_id);
        return view('401_edit_budget');
    }
}
