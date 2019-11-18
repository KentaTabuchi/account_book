<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\SQL\_201_index\SQL;
/*
|--------------------------------------------------------------------------
| 目次画面のコントローラー
|--------------------------------------------------------------------------
*/
class InputBookController extends Controller
{
    public function input_book_get(Request $request){
        if(is_null($request->balance_code)){
            $category_balance = SQL::select_balance();
            $category_large = SQL::select_large("1");
            $category_middle = SQL::select_middle("2");
            $category_small = SQL::select_small("2");
        }
        else{
            $category_balance = SQL::select_balance();
            $category_large = SQL::select_large($request->balance_code);
            $category_middle = SQL::select_middle("2");
            $category_small = SQL::select_small("2");  
            //前回選択したセレクトの値を取得して初期値として渡す。
        }
        return view('201_input_book',
            compact('category_balance',
                    'category_large',
                    'category_middle',
                    'category_small'
                ));
    }

    public function input_book_post(Request $request){
        $category_balance = SQL::select_balance();     
        switch($request->changed_form){
            case "category_balance":
                $balance_code = SQL::select_balance_code($request->category_balance);
            break;
            case "category_large":
                $balance_code = SQL::select_balance_code($request->category_balance);
                $large_code = SQL::select_large_code($request->category_large);
            break;
            case "category_middle":
            break;
            default:
                dd("default");
            break;
        }
        // return redirect()->action('InputBookController@input_book_get2', ['balance_code' => $balance_code]);
        return redirect('input_book'.'?balance_code='.$balance_code);
    }
    //=====================================================================================
    //　jsonを返すapi vueから呼び出し、セレクトボックスへバインドする
    //=====================================================================================
    public function json_balance(Request $request){
        $category_balance = SQL::select_balance();   
        $category_balance_encorded = json_encode($category_balance,JSON_UNESCAPED_UNICODE);
        return $category_balance_encorded;
    }
    public function json_large(Request $request){
        $category_large = SQL::select_large("1");   
        $category_large_encorded = json_encode($category_large,JSON_UNESCAPED_UNICODE);
        return $category_large_encorded;
    }
    public function json_middle(Request $request){
        $category_middle = SQL::select_middle("1");   
        $category_middle_encorded = json_encode($category_middle,JSON_UNESCAPED_UNICODE);
        return $category_middle_encorded;
    }
    public function json_small(Request $request){
        $category_small = SQL::select_small("1");   
        $category_small_encorded = json_encode($category_small,JSON_UNESCAPED_UNICODE);
        return $category_small_encorded;
    }
}
