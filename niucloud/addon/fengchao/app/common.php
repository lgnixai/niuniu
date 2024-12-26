<?php
function Asuccess($msg = 'SUCCESS', $data = [], int $code = 1, int $http_code = 200) : Response
{
    if (is_array($msg)) {
        $data = $msg;
        $msg = 'SUCCESS';
    }
    return Response::create([ 'data' => $data, 'msg' => get_lang($msg), 'code' => $code ], 'json', $http_code);

}

function Afail($data = []) : Response
{

    return Response::create( $data, 'json', 200);
}
