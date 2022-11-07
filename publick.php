<?php
const COLOR_PRIMARY = 'primary';
const COLOR_NEGATIVE = 'negative';
const COLOR_positive = 'positive';
const COLOR_DEFAULT = 'default';

function getBtn($label, $color, $payload = '') {
    return [
        'action' => [
            'type' => 'text',
            "payload" => json_encode($payload, JSON_UNESCAPED_UNICODE),
            'label' => $label
        ],
        'color' => $color
    ];
}
function replace_file($path, $string, $replace)
{
    set_time_limit(0);

    if (is_file($path) === true)
    {
        $file = fopen($path, 'r');
        $temp = tempnam('./', 'tmp');

        if (is_resource($file) === true)
        {
            while (feof($file) === false)
            {
                file_put_contents($temp, str_replace($string, $replace, fgets($file)), FILE_APPEND);
            }

            fclose($file);
        }

        unlink($path);
    }

    return rename($temp, $path);
}
function getBtna($label, $color, $payload = '',$label_1, $color_1, $payload_1 = '') {
	return 	[
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload, JSON_UNESCAPED_UNICODE),
			'label' => $label
		],
		'color' => $color,
	],
	[
		'action' => [
			'type' => 'text',
			'payload' => json_encode($payload_1, JSON_UNESCAPED_UNICODE),
			'label' => $label_1
		],
		'color' => $color_1,
	],
	];
}
function getBtnlink($label, $color, $payload) {
    return [
        'action' => [
			'type' => 'open_link',
			'link' =>  $payload,
            'label' => $label
        ],
    ];
}
function message($user_id, $text, $kbd = '', $photo = '') {
	if($kbd != ''){
		if($photo != ''){
			$request_params = array( 
				'message' => $text, 
				'peer_id' => $user_id, 
				'keyboard' => json_encode($kbd, JSON_UNESCAPED_UNICODE),
				'access_token' => $GLOBALS['token'], 
				'v' => '5.81',
				'attachment' => $photo,
			); 
			$date = http_build_query($request_params); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
			curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			return json_decode($result, 1);
		}
		else{
			$request_params = array( 
				'message' => $text, 
				'peer_id' => $user_id, 
				'keyboard' => json_encode($kbd, JSON_UNESCAPED_UNICODE),
				'access_token' => $GLOBALS['token'], 
				'v' => '5.81'
			); 
			$date = http_build_query($request_params); 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
			curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$result = curl_exec($ch);
			return json_decode($result, 1);
		}
	}
	elseif($photo != ''){
		$request_params = array( 
			'message' => $text, 
			'peer_id' => $user_id, 
			'access_token' => $GLOBALS['token'],  
			'v' => '5.81',
			'attachment' => $photo,
		); 
		$date = http_build_query($request_params); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
		curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return json_decode($result, 1);
	}
	else{
		$request_params = array( 
			'message' => $text, 
			'peer_id' => $user_id, 
			'access_token' => $GLOBALS['token'], 
			'v' => '5.81'
		); 
		$date = http_build_query($request_params); 
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
		curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/messages.send?");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($ch);
		return json_decode($result, 1); 
	}
}
function num_word($value, $words, $show = true) 
{
	$num = $value % 100;
	if ($num > 19) { 
		$num = $num % 10; 
	}
	
	$out = ($show) ?  $value . ' ' : '';
	switch ($num) {
		case 1:  $out .= $words[0]; break;
		case 2: 
		case 3: 
		case 4:  $out .= $words[1]; break;
		default: $out .= $words[2]; break;
	}
	
	return $out;
}
function secToStr($secs)
{
	$res = '';
	
	$days = floor($secs / 86400);
	$secs = $secs % 86400;
	if($days > 0){
		$res .= num_word($days, array('день', 'дня', 'дней')) . ' ';
	}
	
	$hours = floor($secs / 3600);
	$secs = $secs % 3600;
	if($hours > 0){
		$res .= num_word($hours, array('час', 'часа', 'часов')) . ' ';
	}
	$minutes = floor($secs / 60);
	$secs = $secs % 60;
	if($minutes > 0){
		$res .= num_word($minutes, array('минута', 'минуты', 'минут')) . ' ';
	}
	
	return $res;
}