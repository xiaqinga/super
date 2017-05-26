<?php

/**
 * 微信ACCESSTOKEN控制器
 *
 * @author  lsw
 * @date    2015-08-5
 * @version 1.0
 */
class access_token extends Controller
{
    /**
     * 初始化
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getItem()
    {
        $resp = $this->model->read('access_token', 'getItem');
        echo json_encode($resp);
    }

    public function setToken()
    {
        $param = array(
            'access_token' => $this->queryVar('access_token'),
            'expires_in'   => '7200',
            'create_time'  => $this->queryVar('create_time')
        );
        $resp  = $this->model->write('access_token', 'setToken', $param);
        echo json_encode($resp);
    }

    public function del()
    {
        $param = array(
            'expires_in' => '7200'
        );
        $resp  = $this->model->write('access_token', 'del', $param);
        echo json_encode($resp);
    }

    public function clear()
    {
        $resp = $this->model->write('access_token', 'clear');
        echo json_encode($resp);
    }
}

?>