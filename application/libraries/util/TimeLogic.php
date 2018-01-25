<?php

class TimeLogic
{
    private $CI;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->current_time = $this->get_time();
    }

    /**
     * 現在時刻
     * @access public
     * @return int
     */
    public function get_time()
    {
        return time();
    }

    /**
     * フォーマット文字列によりフォーマットされた時刻を返す
     * @access public
     * @param $format           出力される日付文字列の書式
     * @param null $time_stamp  Unixタイムスタンプ。指定されてない場合は現在時刻のタイムスタンプを使用します。
     * @return bool|string      日付を表す文字列
     */
    public function get_date($format, $time_stamp = null)
    {
        if (is_null($time_stamp)) {
            // タイムスタンプが指定されてない場合は現在時刻を使用する
            $time = $this->get_time();
        } else {
            // タイムスタンプが指定されている場合は指定されたタイムスタンプを使用する
            $time = $time_stamp;
        }
        return date($format, $time);
    }

    /**
     * 期間内かどうか調べる
     *
     * @param start_time 開始日時 datetime型
     * @param add_second 開始日時からの経過秒数
     * @param inspect_unixtime 期間内か調べる日時。主に現在日時などが入る。 unixtime型
     * @return TRUE: 期間内  FALSE: 期間外
     */
    public function is_in_time($start_time, $add_second, $inspect_unixtime)
    {
        $start_unixtime = strtotime($start_time);
        $end_time = strtotime($add_second . 'second', $start_unixtime);

        return ($start_unixtime <= $inspect_unixtime) && ($inspect_unixtime <= $end_time);
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
    public function is_in_time_by_all_time($start_time, $end_time, $inspect_time)
    {
        $start_unixtime = strtotime($start_time);
        $end_unixtime = strtotime($end_time);
        $inspect_unixtime = strtotime($inspect_time);

        return ($start_unixtime <= $inspect_unixtime) && ($inspect_unixtime <= $end_unixtime);
    }

    /**
     * 差分時間を取得(分)
     *
     * @param start_time 開始日時 datetime型
     * @param end_time 終了日時 datetime型
     * @return 差分時間(分)
     */
    public function get_diff_minute_time($start_time, $end_time)
    {
        return floor((strtotime($end_time) - strtotime($start_time)) / 60);
    }

    /**
     * 差分時間を取得
     *
     * @param start_time 開始日時 datetime型
     * @param end_time 終了日時 datetime型
     * @return 差分時間(秒)
     */
    public function get_diff_date_time($start_time, $end_time)
    {
        return (strtotime($end_time) - strtotime($start_time));
    }

    /**
     * 同じ月かどうか
     */
    public function is_same_month($target, $current = null)
    {
        if (empty($current)) {
            $current = $this->CI->current_time;
        }

        if (is_string($current)) {
            $current = strtotime($current);
        }

        if (is_string($target)) {
            $target = strtotime($target);
        }

        $current_month = date("Ym", $current);
        $target_month = date("Ym", $target);

        return $current_month == $target_month;
    }
}
