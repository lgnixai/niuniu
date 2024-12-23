<?php

namespace addon\fengchao\app\service\core\common;

use core\base\BaseApiService;
use Exception;

use think\facade\Cache;

/**
 * webhook群钩子通知封装
 */
class MsgService extends BaseApiService
{
    public function __construct()
    {
        parent::__construct();

    }

    public function SendMsg( $text)
    {

        $data = [
            'msgtype' => 'text',
            'text' => [
                "content" => $text . '---' . date('Y-m-d H:i:s')
            ],
        ];
        $data = json_encode($data);
        $this->http_post("https://open.larksuite.com/open-apis/bot/v2/hook/bb52e68b-c770-4547-adf6-d218f94faf9d", $data);
        return true;
    }

    public function http_post($url, $data = null, $headers = false)
    {
        if($url==''){
            return true;
        }
        $curl = curl_init();
        //设置header头
        if ($headers !== false) {
            if (!is_array($headers)) {
                $headers = array($headers);
            }
            $headers[] = 'Content-Type: application/json';
            curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        } else {
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            throw new Exception($err);
        } else {
            return json_decode($result, true);
        }
    }

}