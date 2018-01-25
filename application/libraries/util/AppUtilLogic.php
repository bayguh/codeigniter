<?php

class AppUtilLogic
{
    private $CI;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->CI = &get_instance();
    }

    /**
     * ランダム値を取得
     *
     * @param min 最小値
     * @param max 最大値
     * @return ランダム値
     */
    public function app_rand($min = null, $max = null)
    {
        return mt_rand($min, $max);
    }

    /**
     * 配列が連想配列かどうか
     *
     * @param array $array
     * @return boolean
     */
    public function is_hash($array)
    {
        $i = 0;
        foreach ($array as $k => $v) {
            if ($k !== $i++) {
                return true;
            }
        }
        return false;
    }

    /**
     * スネークケース文字列をアッパーキャメルケース(UCC)文字列にして返す。
     *
     * @return string
     */
    public function str_snake_to_ucc($snk)
    {
        $ucc = '';
        foreach (explode('_', $snk) as $word) {
            $ucc .= ucwords($word);
        }
        return $ucc;
    }

    /**
     * 目標値と現在地を比較し
     * 百分率を取得
     */
    public function get_percentage($current, $goal)
    {
        $current = (int) $current;
        $goal = (int) $goal;
        return ($current / $goal) * 100;
    }

    /**
     * $keyをキーにした連想配列に変換
     *
     * @param $key キー
     * @param $data 連想配列
     */
    public function conv_on_key($key, $data)
    {
        if (is_null($data)) {
            return null;
        }
        $ret = array();
        foreach ($data as $val) {
            if (!isset($val[$key])) {
                throw new Exception(__CLASS__ . ':行数:' . __LINE__ . ' keyの含まれていない配列が存在します', $this->CI->action_error_code);
            }
            $ret[$val[$key]] = $val;
        }
        return $ret;
    }

    /**
     * 配列をキーで参照してソートする
     *
     * @param &$data_list 配列の参照
     * @param $key 比較するキー
     * @param $order 比較方法(ascending:昇順、descending:降順)
     */
    public function sort_by_key(&$data_list, $key, $order = 'ascending')
    {
        $CI = &get_instance();
        if ($order == 'ascending') {
            usort($data_list, function ($a, $b) use ($key) {
                if (!isset($a[$key]) || !isset($b[$key])) {
                    throw new Exception(__CLASS__ . ':行数:' . __LINE__ . ' keyの含まれていない配列が存在します', $this->CI->action_error_code);
                }
                return $a[$key] > $b[$key];
            });
        } else if ($order == 'descending') {
            usort($data_list, function ($a, $b) use ($key) {
                if (!isset($a[$key]) || !isset($b[$key])) {
                    throw new Exception(__CLASS__ . ':行数:' . __LINE__ . ' keyの含まれていない配列が存在します', $this->CI->action_error_code);
                }
                return $a[$key] < $b[$key];
            });
        } else {
            throw new Exception(__CLASS__ . ':行数:' . __LINE__ . ' 順序指定が不正です order:' . $order, $this->CI->action_error_code);
        }
    }

    /**
     * 連想配列から特定のキーの特定の値が内包された配列を抽出
     *
     * @param type $target 元の配列
     * @param type $key 配列内のキー
     * @param type $value 比較する値
     * @return 抽出した配列
     */
    public function extract_by($target, $key, $value)
    {
        if (is_null($target)) {
            return null;
        }
        if (is_array($target) && count($target) == 0) {
            return [];
        }

        $arg = $this->scalar2array($value);
        $ret = array_values(
            array_filter(
                $target,
                function ($item) use ($arg, $key) {
                    if (isset($item[$key])) {
                        return in_array($item[$key], $arg);
                    }
                }));
        return $ret;
    }

    /**
     * 連想配列から特定のキーの特定の値が含まれた配列を除外
     *
     * @param type $target 元の配列
     * @param type $key 配列内のキー
     * @param type $value 比較する値
     * @return 除外した配列
     */
    public function exclude_by($target, $key, $value)
    {
        if ($target == null or !is_array($target)) {
            return null;
        }
        $arg = $this->scalar2array($value);
        $ret = array_values(
            array_filter(
                $target,
                function ($item) use ($arg, $key) {
                    if (isset($item[$key])) {
                        return !in_array($item[$key], $arg);
                    }
                    return true;
                }));
        return $ret;
    }

    /**
     * 引数がスカラ値だったら配列化する
     */
    private function scalar2array($arg)
    {
        return is_array($arg) ? $arg : array($arg);
    }
}
