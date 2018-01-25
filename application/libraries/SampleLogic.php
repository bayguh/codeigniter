<?php

class SampleLogic
{
    private $CI;

    /**
     * コンストラクタ
     */
    public function __construct()
    {
        $this->CI = &get_instance();

        // Model
        $this->CI->load->model('user_model');
    }

    public function sample($user_id)
    {
        // select
        $user      = $this->CI->user_model->get_record(['user_id' => 100000050], ['user_id', 'name']);
        $user_list = $this->CI->user_model->get_list(null, ['user_id', 'name']);

        // insert
        $record = [
            'user_id'          => 900000001,
            'name'             => '900000001',
            'experience_value' => 1,
            'rank'             => 1,
            'main_deck_number' => 1,
            'money'            => 100,
            'soul'             => 100,
            'birthday'         => '2000-12-1 12:00:00',
        ];
        $this->CI->user_model->insert($record);

        $record_list[] = [
            'user_id'          => 900000002,
            'name'             => '900000002',
            'experience_value' => 1,
            'rank'             => 1,
            'main_deck_number' => 1,
            'money'            => 100,
            'soul'             => 100,
            'birthday'         => '2000-12-1 12:00:00',
        ];
        $record_list[] = [
            'user_id'          => 900000003,
            'name'             => '900000003',
            'experience_value' => 1,
            'rank'             => 1,
            'main_deck_number' => 1,
            'money'            => 100,
            'soul'             => 100,
            'birthday'         => '2000-12-1 12:00:00',
        ];
        $this->CI->user_model->insert_batch($record_list);

        // update
        $this->CI->user_model->update(['money' => 500], ['user_id' => 900000003]);

        // count
        $count = $this->CI->user_model->count_all_results(['money' => 500]);

        // delete
        $this->CI->user_model->physical_delete(['user_id' => 900000001]);
        $this->CI->user_model->physical_delete(['user_id' => 900000002]);
        $this->CI->user_model->physical_delete(['user_id' => 900000003]);

        $data = [
            'user_id' => $user_id,
            'name'    => 'bayguh',
            'time'    => get_date('Y-m-d H:i:s', $this->CI->current_time),
        ];

        return $data;
    }
}
