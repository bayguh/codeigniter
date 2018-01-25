<?php

/**
 * ユーザモデル
 */
class User_model extends MY_Model
{
    // カラムリスト
    public $column_list = [
        'user_id'          => 'int',
        'name'             => 'string',
        'experience_value' => 'int',
        'rank'             => 'int',
        'main_deck_number' => 'int',
        'money'            => 'int',
        'soul'             => 'int',
        'birthday'         => 'string',
    ];

    // コンストラクタ
    public function __construct()
    {
        parent::__construct();
    }
}
