<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Test extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('TestLogic');
    }

    public function index($param1 = null, $param2 = null)
    {
        echo 'TEST';

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
        $result = $this->testlogic->sample($user_id);
        $this->output->output_json($result);
    }
}
