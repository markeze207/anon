<?
    $query = "SELECT * FROM `user` WHERE user_id = '".$user_id."'";
	$sql = mysqli_query ($link,$query);
	if (mysqli_num_rows($sql) > 0){
		$user = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `user` WHERE user_id = '".$user_id."'"));
		if($message == '/add' and $user_id == '84164262') {
			$link->query("UPDATE `user` SET `peremen`='3' WHERE user_id = '".$user_id."' LIMIT 1");
			$kbd = [
				'one_time' => false,
				'buttons' => [
					[getBtn("Закончить", 'primary', 'Закончить')],
				]
			];
			message($user_id,'Введи слово/строку для добавления',$kbd);
		}
		if($user['chat_user'] == 0 and empty($data->object->message->payload) and $user['peremen'] == 0) {
			$kbd = [
				'one_time' => false,
				'buttons' => [
					[getBtn("🎲Случайный собеседник", 'secondary', 'Случайный')],
					[getBtn("❤️Поиск по полу", 'secondary', 'По_полу'), getBtn("😈 Пошлый чат",'secondary','Пошлый_чат')],
					[getBtn("🛠 Профиль", 'secondary', 'Профиль')],
				]
			];
			message($user_id,'⚡️Выбери действие:',$kbd);
		}
	}
	else{
		$link->query("INSERT INTO `user`(`user_id`) VALUES ('".$user_id."')");
		$user = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `user` WHERE user_id = '".$user_id."' LIMIT 1"));
		$kbd = [
			'one_time' => false,
			'buttons' => [
				[getBtn("Парень", 'primary', 'Парень'),getBtn("Девушка", 'positive', 'Девушка')],
			]
		];
		message($user_id,'Укажи свой пол',$kbd);
	}