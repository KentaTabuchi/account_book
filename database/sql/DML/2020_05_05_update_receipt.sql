use account_book;
BEGIN;

/**
*  大分類のコードを変更
*/
UPDATE receipts SET large_code = 1 WHERE large_code = 11;
UPDATE receipts SET large_code = 2 WHERE large_code = 12; 
UPDATE receipts SET large_code = 3 WHERE large_code = 21; 
UPDATE receipts SET large_code = 4 WHERE large_code = 22; 

/**
*  中分類のコードを変更
*/
UPDATE receipts SET middle_code = 1  WHERE middle_code = 111;
UPDATE receipts SET middle_code = 2  WHERE middle_code = 121; 
UPDATE receipts SET middle_code = 3  WHERE middle_code = 122; 
UPDATE receipts SET middle_code = 4  WHERE middle_code = 211;
UPDATE receipts SET middle_code = 5  WHERE middle_code = 212;
UPDATE receipts SET middle_code = 6  WHERE middle_code = 213; 
UPDATE receipts SET middle_code = 7  WHERE middle_code = 221; 
UPDATE receipts SET middle_code = 8  WHERE middle_code = 222; 
UPDATE receipts SET middle_code = 9  WHERE middle_code = 223;
UPDATE receipts SET middle_code = 10 WHERE middle_code = 224; 
UPDATE receipts SET middle_code = 11 WHERE middle_code = 225; 
UPDATE receipts SET middle_code = 12 WHERE middle_code = 226; 

/**
*  小分類のコードを変更
*/
UPDATE receipts SET small_code = 1  WHERE small_code = 1111;
UPDATE receipts SET small_code = 2  WHERE small_code = 1112; 
UPDATE receipts SET small_code = 3  WHERE small_code = 1120; 
UPDATE receipts SET small_code = 4  WHERE small_code = 1121;
UPDATE receipts SET small_code = 5  WHERE small_code = 1130;
UPDATE receipts SET small_code = 6  WHERE small_code = 2110; 
UPDATE receipts SET small_code = 7  WHERE small_code = 2111; 
UPDATE receipts SET small_code = 8  WHERE small_code = 2112; 
UPDATE receipts SET small_code = 9  WHERE small_code = 2120;
UPDATE receipts SET small_code = 10 WHERE small_code = 2121;
UPDATE receipts SET small_code = 11 WHERE small_code = 2122; 
UPDATE receipts SET small_code = 11 WHERE small_code = 2123; 
UPDATE receipts SET small_code = 12 WHERE small_code = 2124;
UPDATE receipts SET small_code = 13 WHERE small_code = 2125;
UPDATE receipts SET small_code = 14 WHERE small_code = 2126;
UPDATE receipts SET small_code = 15 WHERE small_code = 2127;
UPDATE receipts SET small_code = 16 WHERE small_code = 2131;
UPDATE receipts SET small_code = 17 WHERE small_code = 2210;
UPDATE receipts SET small_code = 18 WHERE small_code = 2211;
UPDATE receipts SET small_code = 19 WHERE small_code = 2212;
UPDATE receipts SET small_code = 20 WHERE small_code = 2213;
UPDATE receipts SET small_code = 21 WHERE small_code = 2214;
UPDATE receipts SET small_code = 22 WHERE small_code = 2220;
UPDATE receipts SET small_code = 23 WHERE small_code = 2221;
UPDATE receipts SET small_code = 24 WHERE small_code = 2222;
UPDATE receipts SET small_code = 25 WHERE small_code = 2223;
UPDATE receipts SET small_code = 26 WHERE small_code = 2224;
UPDATE receipts SET small_code = 27 WHERE small_code = 2230;
UPDATE receipts SET small_code = 28 WHERE small_code = 2231;
UPDATE receipts SET small_code = 29 WHERE small_code = 2240;
UPDATE receipts SET small_code = 30 WHERE small_code = 2241;
UPDATE receipts SET small_code = 31 WHERE small_code = 2250;
UPDATE receipts SET small_code = 32 WHERE small_code = 2250;
UPDATE receipts SET small_code = 33 WHERE small_code = 2251;
UPDATE receipts SET small_code = 34 WHERE small_code = 2252;
UPDATE receipts SET small_code = 35 WHERE small_code = 2253;

COMMIT;