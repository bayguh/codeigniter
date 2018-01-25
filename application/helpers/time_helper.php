<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * time_helper.php
 * @author Makoto Korenaga <korenaga@sumzap.co.jp>
 * @copyright 2010-2013 SUMZAP
 */
/**
 * トランザクション時間(TimeLogicがロードされた時間)をUnixエポック(1970年1月1日 00:00:00 GMT)からの通算秒として返す
 * ※1リクエスト中同じ時間を返す
 *
 * @return トランザクション時間
 */
if (!function_exists('get_transaction_time')) {
    function get_transaction_time()
    {
        $CI = &get_instance();
        return $CI->timelogic->get_transaction_time();
    }
}

/**
 * フォーマット文字列によりフォーマットされたトランザクション時間の時刻を返す
 *
 * @param $format 出力される日付文字列の書式
 * @return 日付を表す文字列
 */
if (!function_exists('get_transaction_date')) {
    function get_transaction_date($format)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_transaction_date($format);
    }
}

/**
 * 現在時刻(デバッグ用に変更した場合は変更した時刻)をUnixエポック(1970年1月1日 00:00:00 GMT)からの通算秒として返す
 * @return int
 */
if (!function_exists('get_time')) {
    function get_time()
    {
        $CI = &get_instance();
        return $CI->timelogic->get_time();
    }
}

/**
 * フォーマット文字列によりフォーマットされた時刻を返す
 * @param $format           出力される日付文字列の書式
 * @param null $time_stamp  Unixタイムスタンプ。指定されてない場合は現在時刻のタイムスタンプを使用します。
 * @return bool|string      日付を表す文字列
 */
if (!function_exists('get_date')) {
    function get_date($format, $time_stamp = null)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_date($format, $time_stamp);
    }
}

/**
 * 時刻変更オフセットの設定
 * @param $offset_second int    現在時刻からずらしたい分の秒数を設定する。<br />
 *                              未来に進めたい場合は正の数値、過去に戻したい場合は負の数値を使用する。
 * @param bool $reset_flag      時刻変更オフセットが既に設定されている場合にリセットしてからずらすかのフラグ。<br />
 *                              trueなら一度オフセットをリセットからずらす、falseなら設定されているオフセットから<br />
 *                              さらにずらす。
 * @return bool
 */
if (!function_exists('set_offset_time')) {
    function set_offset_time($offset_second, $reset_flag = false)
    {
        $CI = &get_instance();
        return $CI->timelogic->set_offset_time($offset_second, $reset_flag);
    }
}

/**
 * 時刻変更オフセットのクリア
 * デバッグ用にずらした時刻を元に戻します
 */
if (!function_exists('clear_offset_time')) {
    function clear_offset_time()
    {
        $CI = &get_instance();
        return $CI->timelogic->set_offset_time(0, true);
    }
}

/**
 * 期間内かどうか調べる
 *
 * @param start_time 開始日時 datetime型
 * @param add_second 開始日時からの経過秒数
 * @param inspect_unixtime 期間内か調べる日時。主に現在日時などが入る。 unixtime型
 * @return TRUE: 期間内  FALSE: 期間外
 */
if (!function_exists('is_in_time')) {
    function is_in_time($start_time, $add_second, $inspect_unixtime)
    {
        $CI = &get_instance();
        return $CI->timelogic->is_in_time($start_time, $add_second, $inspect_unixtime);
    }
}

/**
 * 期間内かどうか調べる(全てtime型)
 *  ※time型は以下を参照 http://jp2.php.net/manual/ja/datetime.formats.time.php
 *
 * @param start_time 開始日時 time型
 * @param end_time 終了日時 time型
 * @param inspect_time 期間内か調べる日時。主に現在日時などが入る。 time型
 * @return TRUE: 期間内  FALSE: 期間外
 */
if (!function_exists('is_in_time_by_all_time')) {
    function is_in_time_by_all_time($start_time, $end_time, $inspect_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->is_in_time_by_all_time($start_time, $end_time, $inspect_time);
    }
}

/**
 * 差分時間を取得(分)
 *
 * @param start_time 開始日時 datetime型
 * @param end_time 終了日時 datetime型
 * @return 差分時間(分)
 */
if (!function_exists('get_diff_minute_time')) {
    function get_diff_minute_time($start_time, $end_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_diff_minute_time($start_time, $end_time);
    }
}

/**
 * 差分時間を取得
 *
 * @param start_time 開始日時 datetime型
 * @param end_time 終了日時 datetime型
 * @return 差分時間(秒)
 */
if (!function_exists('get_diff_date_time')) {
    function get_diff_date_time($start_time, $end_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_diff_date_time($start_time, $end_time);
    }
}

/**
 * 前回のアプリリセット時間取得
 *
 * @param date_time 指定日時 unixtime型
 * @return 前回のアプリリセット時間(unixtime)
 */
if (!function_exists('get_app_last_reset_time')) {
    function get_app_last_reset_time($date_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_app_last_reset_time($date_time);
    }
}

/**
 * 次回のアプリリセット時間取得
 *
 * @param date_time 指定日時 unixtime型
 * @return 次回のアプリリセット時間(unixtime)
 */
if (!function_exists('get_app_next_reset_time')) {
    function get_app_next_reset_time($date_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_app_next_reset_time($date_time);
    }
}

/**
 * 次回のアプリ月次リセット時間取得
 *
 * @param date_time 指定日時 unixtime型
 * @return 次回のアプリリセット時間(unixtime)
 */
if (!function_exists('get_app_next_month_reset_time')) {
    function get_app_next_month_reset_time($date_time)
    {
        $CI = &get_instance();
        return $CI->timelogic->get_app_next_month_reset_time($date_time);
    }
}

if (!function_exists("is_same_month")) {
    function is_same_month($target, $current = null)
    {
        $CI = &get_instance();
        return $CI->timelogic->is_same_month($target, $current);
    }
}
