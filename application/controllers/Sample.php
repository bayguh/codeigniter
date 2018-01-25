<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sample extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('SampleLogic');
    }

    public function index($param1 = null, $param2 = null)
    {
        echo 'Sample';

        if (!is_null($param1)) {
            echo '<br/ >param1: ' . $param1;
        }
        if (!is_null($param2)) {
            echo '<br/ >param2: ' . $param2;
        }
    }

    public function sample()
    {
        $user_id = 1;
        $result = $this->samplelogic->sample($user_id);
        $this->output->output_json($result);
    }
}
