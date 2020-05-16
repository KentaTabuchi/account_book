use account_book;
BEGIN;

/**
*  小分類のコードを変更
*/
UPDATE monthly_cost SET small_code = 1  WHERE small_code = 1111;
UPDATE monthly_cost SET small_code = 2  WHERE small_code = 1112; 
UPDATE monthly_cost SET small_code = 3  WHERE small_code = 1120; 
UPDATE monthly_cost SET small_code = 4  WHERE small_code = 1121;
UPDATE monthly_cost SET small_code = 5  WHERE small_code = 1130;
UPDATE monthly_cost SET small_code = 6  WHERE small_code = 2110; 
UPDATE monthly_cost SET small_code = 7  WHERE small_code = 2111; 
UPDATE monthly_cost SET small_code = 8  WHERE small_code = 2112; 
UPDATE monthly_cost SET small_code = 9  WHERE small_code = 2120;
UPDATE monthly_cost SET small_code = 10 WHERE small_code = 2121;
UPDATE monthly_cost SET small_code = 11 WHERE small_code = 2122; 
UPDATE monthly_cost SET small_code = 11 WHERE small_code = 2123; 
UPDATE monthly_cost SET small_code = 12 WHERE small_code = 2124;
UPDATE monthly_cost SET small_code = 13 WHERE small_code = 2125;
UPDATE monthly_cost SET small_code = 14 WHERE small_code = 2126;
UPDATE monthly_cost SET small_code = 15 WHERE small_code = 2127;
UPDATE monthly_cost SET small_code = 16 WHERE small_code = 2131;
UPDATE monthly_cost SET small_code = 17 WHERE small_code = 2210;
UPDATE monthly_cost SET small_code = 18 WHERE small_code = 2211;
UPDATE monthly_cost SET small_code = 19 WHERE small_code = 2212;
UPDATE monthly_cost SET small_code = 20 WHERE small_code = 2213;
UPDATE monthly_cost SET small_code = 21 WHERE small_code = 2214;
UPDATE monthly_cost SET small_code = 22 WHERE small_code = 2220;
UPDATE monthly_cost SET small_code = 23 WHERE small_code = 2221;
UPDATE monthly_cost SET small_code = 24 WHERE small_code = 2222;
UPDATE monthly_cost SET small_code = 25 WHERE small_code = 2223;
UPDATE monthly_cost SET small_code = 26 WHERE small_code = 2224;
UPDATE monthly_cost SET small_code = 27 WHERE small_code = 2230;
UPDATE monthly_cost SET small_code = 28 WHERE small_code = 2231;
UPDATE monthly_cost SET small_code = 29 WHERE small_code = 2240;
UPDATE monthly_cost SET small_code = 30 WHERE small_code = 2241;
UPDATE monthly_cost SET small_code = 31 WHERE small_code = 2250;
UPDATE monthly_cost SET small_code = 32 WHERE small_code = 2250;
UPDATE monthly_cost SET small_code = 33 WHERE small_code = 2251;
UPDATE monthly_cost SET small_code = 34 WHERE small_code = 2252;
UPDATE monthly_cost SET small_code = 35 WHERE small_code = 2253;

COMMIT;