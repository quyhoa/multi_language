<?php
/* Database config */
define("DB_ADDR",'localhost');
define("DB_NAME","multi_language");
define("DB_USER",'root');
define("DB_PASS","rsdn20120903");
define('FROM_LANGUAGE','jpn');//jpn,ja
define('TO_LANGUAGE','eng');//eng,en
define('TIME_COOKIE', 3600);

/* URL */
if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != 80) {
    define('SITE_URL', "http://".$_SERVER['SERVER_NAME'].":".$_SERVER['SERVER_PORT']."/");
}else if(isset($_SERVER['SERVER_NAME'])) {
    define('SITE_URL', "http://".$_SERVER['SERVER_NAME']."/");
}
define('DEFAULT_ITEM',4);
define('SUBMIT_BUTTON',__('登録'));
define('BACK_BUTTON',__('戻る'));
define('LOGIN_BUTTON','Login');
define('ADD_FOOD','食材追加');
define('ADD_SEA','調味料追加');
define('LABEL_REMEMER','Remember me');
define('TITLE_LOGIN','Please sign in');
define('PREV','前へ');
define('NEXT','次へ');
define('LIMIT',3);
define('SELECT_MENU','持っているメニュー一覧');
/* Message error */
define('ERROR_EMPTY_FIELD','内容を入力してください。');
define('ERROR_EMPTY_FIELD_ADDRESS','メールアドレスを入力してください');
define('ERROR_EMPTY_FIELD_PASS','パスワードを入力してください');
define('ERROR_ADD_MENU','メニュー登録に異常が発生しました。');
define('ERROR_EDIT_MENU','メニュー編集が正常に終わりました。');
define('ERROR_NUMBER_FORMAT','数字を入力してください');
define('ERROR_NUMBER_FORMAT_FOOD','食材数には、0以上の整数を入力してください');
define('ERROR_EMPTY_ITEM_FOOD','食材名を入力してください');
define('ERROR_EMPTY_ITEM_SEASON','調味料名を入力してください');
define('ERROR_EMPTY_SUBMIT_FOOD','食材名を入力してください');
define('ERROR_EMAIL_FORMAT','正しいメールアドレスを入力してください。');
define('ERROR_EMPTY_ITEM','食材名を入力してください');
define('ERROR_ACTION','Action error');
define('ERROR_LOGIN','メールアドレス、またはパスワードが正しくありません');
define('ERROR_LENGTH_PASS','パスワードには6以上の文字を入力してください');
define('ERROR_MENU_EXIST','メニューが既に存在しています。');
define('ERROR_POSITIVE_NUMBER_FOOD','食材数には、0以上の整数を入力してください');
define('ERROR_POSITIVE_NUMBER_SEASON','調味料数には、0以上の整数を入力してください');
define('ERROR_DELETE_FMENU','DELETE FAIL');
define('ERROR_CHANGE_ENGLISH', '福言語で表示する場合は、登録した内容を追加・削除することができません。');

/* Message success */
define('SUCCESS_DELETE_FMENU','削除しました。');
define('SUCCESS_ADD_MENU','メニュー登録が正常に終わりました。');
define('SUCCESS_EDIT_MENU','メニュー編集が正常に終わりました。');

