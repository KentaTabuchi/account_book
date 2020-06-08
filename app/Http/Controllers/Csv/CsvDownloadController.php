<?php

namespace App\Http\Controllers\Csv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Receipt;
use App\Models\CategoryBalance;
use App\Models\CategoryLarge;
use App\Models\CategoryMiddle;
use App\Models\CategorySmall;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

/**
 *  CSV形式でデータをダウンローするクラス
 */
class CsvDownloadController extends Controller
{
    public function export(Request $request)
    {
        $callback = function() use($request){
            // ストリームを開く
            $stream = fopen('php://output','w');

            //ヘッダ(CSVに書き出す列名)の設定
             $head = [
                 'ID'
                ,'日付'
                ,'収支'
                ,'大分類'
                ,'中分類'
                ,'小分類'
                ,'金額'
                ,'メモ'
             ];

            // エクセル用に文字コードを変換する。
            mb_convert_variables('SJIS-win','UTF-8',$head);

            // ストリームにヘッダ部分を書き込む
            fputcsv($stream, $head);

            // DBからデータセットを取り出す。
            $receipts = $this->getReceiptList();

            foreach ($receipts as $receipt) {
                $body = [
                     $receipt->id
                    ,$receipt->pay_day
                    ,$receipt->balance_name
                    ,$receipt->large_name
                    ,$receipt->middle_name
                    ,$receipt->small_name
                    ,$receipt->payment
                ];
                // エクセル用に文字コードを変換する。
                mb_convert_variables('SJIS-win','UTF-8',$body);

                // ストリームに本体部分を書き込む
                fputcsv($stream, $body);
            }
            
             // ストリームを閉じる
             fclose($stream);
        };

        $http_response = \Illuminate\Http\Response::HTTP_OK;

        //ファイル名を生成
        $file_name = 'receipt_list_' . Carbon::now()->format('Ymd');
        
        $headers = [
             'Content-Type' => 'text/csv'
            ,'Content-Disposition' => 'attachment;filename=' . $file_name
        ];

        return response()->stream($callback,$http_response,$headers);
    }

    /**
     *  DBからCSVに書き出すレシート一覧を取得する
     */
    private function getReceiptList()
    {
        //ログイン中のユーザーを取得
        $user = Auth::user();

        //レシートを全件、カテゴリー名を含めて取得する。
        $receipts = Receipt::from('receipts as A')
        ->JoinCategoryCode()
        ->SelectWithCategoryName()
        ->where('user_id',$user->id)
        ->orderBy('pay_day','desc')
        ->get();

        return $receipts;
    }

}
