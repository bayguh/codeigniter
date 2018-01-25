<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class MY_Output extends CI_Output
{
    /**
     * json出力
     */
    public function output_json($data)
    {
        $this->set_content_type("application/json")->set_output(json_encode($data));
    }
}
