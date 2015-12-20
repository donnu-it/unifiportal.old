<?php
require_once('../../../simplesamlphp/lib/_autoload.php');

function sendAuthorization($id, $unifi, $clientParam) {

    $ch = curl_init();

    curl_setopt($ch, CURLOPT_POST, TRUE);

    $cookie_file = "/tmp/unifi_cookie";
    curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file);

    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_SSLVERSION, 1);

    curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer']."/api/login");
    $data = json_encode(array("username" => $unifi['unifiUser'],"password" => $unifi['unifiPass']));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec($ch);

    $data = json_encode(array(
            'cmd'=>'authorize-guest',
            'mac'=>$id,
            'minutes'=>$clientParam['sessionTime'],
            'up'=>$clientParam['up'],
            'down'=>$clientParam['down']
            ));

    curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer'].'/api/s/'.$unifi['unifiPortal'].'/cmd/stamgr');
    curl_setopt($ch, CURLOPT_POSTFIELDS, 'json='.$data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_exec ($ch);

    curl_setopt($ch, CURLOPT_URL, $unifi['unifiServer'].'/logout');
    curl_exec ($ch);
    curl_close ($ch);
}

function selectTypeUsers($id, $clientParam, $vipUsers, $unifi, &$arrVip){
    foreach($vipUsers as $nameUsers => $massiv){       
        if(in_array($id, $massiv)){
            $arrVip = $vipUsers[$nameUsers];
            return $arrVip;
        }    
    }
}
?>