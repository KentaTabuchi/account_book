use account_book;
BEGIN;

/**
*  大分類のコードを変更
*/
UPDATE category_large SET code = 1 WHERE code = 11;
UPDATE category_large SET code = 2 WHERE code = 12; 
UPDATE category_large SET code = 3 WHERE code = 21; 
UPDATE category_large SET code = 4 WHERE code = 22; 

/**
*  中分類のコードを変更
*/
UPDATE category_middle SET code = 1  ,large_code = 1 WHERE code = 111;
UPDATE category_middle SET code = 2  ,large_code = 2 WHERE code = 121; 
UPDATE category_middle SET code = 3  ,large_code = 2 WHERE code = 122; 
UPDATE category_middle SET code = 4  ,large_code = 3 WHERE code = 211;
UPDATE category_middle SET code = 5  ,large_code = 3 WHERE code = 212;
UPDATE category_middle SET code = 6  ,large_code = 3 WHERE code = 213; 
UPDATE category_middle SET code = 7  ,large_code = 4 WHERE code = 221; 
UPDATE category_middle SET code = 8  ,large_code = 4 WHERE code = 222; 
UPDATE category_middle SET code = 9  ,large_code = 4 WHERE code = 223;
UPDATE category_middle SET code = 10 ,large_code = 4 WHERE code = 224; 
UPDATE category_middle SET code = 11 ,large_code = 4 WHERE code = 225; 
UPDATE category_middle SET code = 12 ,large_code = 4 WHERE code = 226; 

/**
*  小分類のコードを変更
*/
UPDATE category_small SET code = 1  ,middle_code = 1 WHERE code = 1111;
UPDATE category_small SET code = 2  ,middle_code = 1 WHERE code = 1112; 
UPDATE category_small SET code = 3  ,middle_code = 2 WHERE code = 1120; 
UPDATE category_small SET code = 4  ,middle_code = 2 WHERE code = 1121;
UPDATE category_small SET code = 5  ,middle_code = 3 WHERE code = 1130;
UPDATE category_small SET code = 6  ,middle_code = 4 WHERE code = 2110; 
UPDATE category_small SET code = 7  ,middle_code = 4 WHERE code = 2111; 
UPDATE category_small SET code = 8  ,middle_code = 4 WHERE code = 2112; 
UPDATE category_small SET code = 9  ,middle_code = 5 WHERE code = 2120;
UPDATE category_small SET code = 10 ,middle_code = 5 WHERE code = 2121;
UPDATE category_small SET code = 11 ,middle_code = 5 WHERE code = 2122; 
UPDATE category_small SET code = 11 ,middle_code = 5 WHERE code = 2123; 
UPDATE category_small SET code = 12 ,middle_code = 5 WHERE code = 2124;
UPDATE category_small SET code = 13  ,middle_code = 5 WHERE code = 2125;
UPDATE category_small SET code = 14 ,middle_code = 5 WHERE code = 2126;
UPDATE category_small SET code = 15 ,middle_code = 5 WHERE code = 2127;
UPDATE category_small SET code = 16 ,middle_code = 6 WHERE code = 2131;
UPDATE category_small SET code = 17 ,middle_code = 7 WHERE code = 2210;
UPDATE category_small SET code = 18 ,middle_code = 7 WHERE code = 2211;
UPDATE category_small SET code = 19 ,middle_code = 7 WHERE code = 2212;
UPDATE category_small SET code = 20 ,middle_code = 7 WHERE code = 2213;
UPDATE category_small SET code = 21 ,middle_code = 7 WHERE code = 2214;
UPDATE category_small SET code = 22 ,middle_code = 8 WHERE code = 2220;
UPDATE category_small SET code = 23 ,middle_code = 8 WHERE code = 2221;
UPDATE category_small SET code = 24 ,middle_code = 8 WHERE code = 2222;
UPDATE category_small SET code = 25 ,middle_code = 8 WHERE code = 2223;
UPDATE category_small SET code = 26 ,middle_code = 8 WHERE code = 2224;
UPDATE category_small SET code = 27 ,middle_code = 9 WHERE code = 2230;
UPDATE category_small SET code = 28 ,middle_code = 9 WHERE code = 2231;
UPDATE category_small SET code = 29 ,middle_code = 10 WHERE code = 2240;
UPDATE category_small SET code = 30 ,middle_code = 10 WHERE code = 2241;
UPDATE category_small SET code = 31 ,middle_code = 11 WHERE code = 2250 AND name='散髪代';
UPDATE category_small SET code = 32 ,middle_code = 12 WHERE code = 2250 AND name='誕生日';
UPDATE category_small SET code = 33 ,middle_code = 13 WHERE code = 2251;
UPDATE category_small SET code = 34 ,middle_code = 14 WHERE code = 2252;
UPDATE category_small SET code = 35 ,middle_code = 15 WHERE code = 2253;

COMMIT;