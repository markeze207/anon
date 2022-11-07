<?
if($user['history'] == 0) {
    message($user_id,'Ты уже жаловался на этого пользователя');
} else {
    $report = mysqli_fetch_assoc(mysqli_query($link,"SELECT * FROM `user` WHERE user_id = '".$user['history']."'"));
    $link->query("UPDATE `user` SET `history`='0' WHERE user_id = '".$user_id."'");
    $link->query("UPDATE `user` SET `report` = `report`+1 WHERE user_id = '".$user['history']."'");
    if($report['report'] == 4) {
        $time = time() + (60 * 60 * 24);
        $link->query("UPDATE `user` SET `ban_time` = '".$time."'  WHERE user_id = '".$user['history']."'");
        message($report['user_id'],'Ты получил 2 репорта, поэтому ты получаешь блокировка на 24ч.');
    }
    elseif($report['report'] == 14) {
        $time = time() + (60 * 60 * 24 * 7);
        $link->query("UPDATE `user` SET `report` = '0', `ban_time` = '".$time."'  WHERE user_id = '".$user['history']."'");
        message($report['user_id'],'Ты получил 5 репортов, поэтому ты получаешь блокировка на 7д.');
    }
    message($user_id,'Ты пожаловался на пользователя');

}

?>