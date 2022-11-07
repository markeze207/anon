<?
$group_id = $data->group_id;
$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890abcdefghijklmnopqrstuvwxyz';
// 1.2. Количество символов в капче
$length = 6;
// 1.3. Генерируем код
$code = substr(str_shuffle($chars), 0, $length);

$image = imagecreatefrompng(__DIR__.'/files/bg.png');
// 3.2 Устанавливаем размер шрифта в пунктах
$size = 36;
// 3.3. Создаём цвет, который будет использоваться в изображении
$color = imagecolorallocate($image, 66, 182, 66);
// 3.4. Устанавливаем путь к шрифту
$font = __DIR__.'/files/oswald.ttf';
// 3.5 Задаём угол в градусах
$angle = rand(-10, 10);
// 3.6. Устанавливаем координаты точки для первого символа текста
$x = 56;
$y = 64;
// 3.7. Наносим текст на изображение
imagefttext($image, $size, $angle, $x, $y, $color, $font, $code);
// 3.8 Устанавливаем заголовки
header('Cache-Control: no-store, must-revalidate');
header('Expires: 0');
header('Content-Type: image/png');
imagepng($image, __DIR__."/files/".'captcha.png');
$ch = curl_init();
$fills = 'file1';
$mass_file[$fills] = new CURLFile(__DIR__."/files/".'captcha.png');
$request_params = array( 
    'group_id' => $group_id,
    'access_token' => $token,
    'v' => '5.81'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/photos.getMessagesUploadServer?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result =  json_decode($result, 1);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $result['response']['upload_url']);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $mass_file);
$datas = json_decode(curl_exec($ch), true);
curl_close($ch);
$request_params = array( 
    'photo' => $datas['photo'],
    'server' => $datas['server'],
    'hash' => $datas['hash'],
    'access_token' => $token, 
    'v' => '5.81'
); 
$date = http_build_query($request_params); 
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $date);
curl_setopt($ch, CURLOPT_URL,"https://api.vk.com/method/photos.saveMessagesPhoto?");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$save =  json_decode($result, 1);
if($save['response'][0]['owner_id'] != 0){$text = 'photo'.$save['response'][0]['owner_id'].'_'.$save['response'][0]['id'].'_'.$save['response'][0]['access_key'];} 
?>