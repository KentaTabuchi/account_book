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
    public function input_book_get(Request $requst){
        $category_balance = SQL::select_balance();
        $category_large = SQL::select_large("2");
        $category_middle = SQL::select_middle("2");
        $category_small = SQL::select_small("2");
        
        return view('201_input_book',
            compact('category_balance',
                    'category_large',
                    'category_middle',
                    'category_small'
                ));
    }
}
