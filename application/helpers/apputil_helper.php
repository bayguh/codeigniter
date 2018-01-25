<?php

/**
 * テストに使用できるようにランダム値を指定できるようにする
 */
if (!function_exists('app_rand')) {
    function app_rand($min, $max)
    {
        $CI = &get_instance();
        return $CI->apputillogic->app_rand($min, $max);
    }
}

/**
 * テストに使用できるようにランダム値を指定できるようにする
 */
if (!function_exists('set_rand_list')) {
    function set_rand_list($rand_list)
    {
        $CI = &get_instance();
        return $CI->apputillogic->set_rand_list($rand_list);
    }
}

/**
 * テストに使用できるようにランダム値を指定できるようにする
 */
if (!function_exists('delete_rand_list')) {
    function delete_rand_list()
    {
        $CI = &get_instance();
        return $CI->apputillogic->delete_rand_list();
    }
}

/**
 * NGワードかどうか
 *
 * @param string $word
 * @return boolean true: NGワード, false: NGワードではない
 */
if (!function_exists('is_ngword')) {
    function is_ngword($word)
    {
        $CI = &get_instance();
        return $CI->apputillogic->is_ngword($word);
    }
}

/**
 * 配列が連想配列かどうか
 *
 * @param array $array
 * @return boolean
 */
if (!function_exists('is_hash')) {
    function is_hash($array)
    {
        $CI = &get_instance();
        return $CI->apputillogic->is_hash($array);
    }
}

/**
 * スネークケース文字列をアッパーキャメルケース(UCC)文字列にして返す。
 *
 * @return string
 */
if (!function_exists('str_snake_to_ucc')) {
    function str_snake_to_ucc($snk)
    {
        $CI = &get_instance();
        return $CI->apputillogic->str_snake_to_ucc($snk);
    }
}

/**
 * 目標値と現在地を比較し
 * 百分率を取得
 */
if (!function_exists('get_percentage')) {
    function get_percentage($current, $goal)
    {
        $CI = &get_instance();
        return $CI->apputillogic->get_percentage($current, $goal);
    }
}

/**
 * $keyをキーにした連想配列に変換
 */
if (!function_exists('conv_on_key')) {
    function conv_on_key($key, $data)
    {
        $CI = &get_instance();
        return $CI->apputillogic->conv_on_key($key, $data);
    }
}

/**
 * 配列をキーで参照してソートする
 *
 * @param &$data_list 配列の参照
 * @param $key 比較するキー
 * @param $order 比較方法(ascending:昇順、descending:降順)
 */
if (!function_exists('sort_by_key')) {
    function sort_by_key(&$data_list, $key, $order = 'ascending')
    {
        $CI = &get_instance();
        return $CI->apputillogic->sort_by_key($data_list, $key, $order);
    }
}

/**
 * 連想配列から特定のキーの特定の値を抽出
 *
 * @param type $target 元の配列
 * @param type $key 配列内のキー
 * @param type $value 比較する値
 * @return 抽出した配列
 */
if (!function_exists('extract_by')) {
    function extract_by($target, $key, $value)
    {
        $CI = &get_instance();
        return $CI->apputillogic->extract_by($target, $key, $value);
    }
}

/**
 * 連想配列から特定のキーの特定の値を除外
 *
 * @param type $target 元の配列
 * @param type $key 配列内のキー
 * @param type $value 比較する値
 * @return 除外した配列
 */
if (!function_exists('exclude_by')) {
    function exclude_by($target, $key, $value)
    {
        $CI = &get_instance();
        return $CI->apputillogic->exclude_by($target, $key, $value);
    }
}

/**
 * MaxExperienceを使用して、レベルの値を算出するロジック
 * Exceptionは外側でキャッチしてもらう
 */
if (!function_exists('calculate_common_parameter')) {
    function calculate_common_parameter($max_value, $min_value, $max_level, $level)
    {
        $CI = &get_instance();
        return $CI->apputillogic->calculate_common_parameter($max_value, $min_value, $max_level, $level);
    }
}

/**
 * csvデータを作成する
 */
if (!function_exists('create_csv')) {
    function create_csv($csv_data, $delimiter = ",", $newline = "\n", $enclosure = '"')
    {
        $CI = &get_instance();
        return $CI->apputillogic->create_csv($csv_data, $delimiter, $newline, $enclosure);
    }
}
