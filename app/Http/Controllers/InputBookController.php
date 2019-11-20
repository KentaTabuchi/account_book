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
        // dd($request->code_balance);
        $category_large = SQL::select_large($request->code_balance);   
        $category_large_encorded = json_encode($category_large,JSON_UNESCAPED_UNICODE);
        return $category_large_encorded;
    }
    public function json_middle(Request $request){
        $category_middle = SQL::select_middle("1");//引数増やして分類と大コードがいる？   
        $category_middle_encorded = json_encode($category_middle,JSON_UNESCAPED_UNICODE);
        return $category_middle_encorded;
    }
    public function json_small(Request $request){
        $category_small = SQL::select_small("1"); //引数増やして分類と大コードがいる？  
        $category_small_encorded = json_encode($category_small,JSON_UNESCAPED_UNICODE);
        return $category_small_encorded;
    }
    //=====================================================================================
    //　jsonを返すapi vueから呼び出し、選択されたセレクトボックスの名前からコードを返す。
    //=====================================================================================
    public function code_balance(Request $request){
        $balance_code = SQL::select_balance_code($request->code); 
        $balance_code_encorded = json_encode($balance_code,JSON_UNESCAPED_UNICODE);
        return $balance_code_encorded;
    }
    public function code_large(Request $request){
        $large_code = SQL::select_large_code($request->code); 
        $large_code_encorded = json_encode($large_code,JSON_UNESCAPED_UNICODE);
        return $large_code_encorded;
    }
    public function code_middle(Request $request){
        $middle_code = SQL::select_middle_code($request->code); 
        $middle_code_encorded = json_encode($middle_code,JSON_UNESCAPED_UNICODE);
        return $middle_code_encorded;
    }
    public function code_small(Request $request){
        $small_code = SQL::select_small_code($request->code); 
        $small_code_encorded = json_encode($small_code,JSON_UNESCAPED_UNICODE);
        return $small_code_encorded;
    }
}
