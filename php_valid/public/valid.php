<?php
$err = array();
$flag = 0;

if($_SERVER['REQUEST_METHOD']== 'POST'){
    if(mb_strlen($_POST['title'])<3 || mb_strlen($_POST['title'])>255) {
        $err['title'] = "<strong class='text-danger'>Заголовок повинен бути не менше трьох та не більше 255 символів.</strong>";
        $flag = 1;
    }
    if( mb_strlen($_POST['annotation'])<30 ||mb_strlen($_POST['annotation'])>500) {
        $err['annotation'] = "<strong class='text-danger'>Анотація не повинна перевищувати 500 символів та мати менше ніж 30 символів.</strong>";
        $flag=1;
    }
    if( mb_strlen($_POST['content'])<100 || mb_strlen($_POST['content'])>30000) {
        $err['content'] = "<strong class='text-danger'>Контент не повинен перевищувати 30000 символів та мати не менше ніж 100 символів.</strong>";
        $flag = 1;
    }
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $err['email'] = "<strong class='text-danger'>Вказано невірний формат e-mail.</strong>";
        $flag = 1;
    }
    if (!filter_var($_POST['views'], FILTER_VALIDATE_INT) || $_POST['views']<0) {
        $err['views'] = "<strong class='text-danger'>Ви невірно вказали перегляди.</strong>";
        $flag = 1;
    }
    if($_POST['date'] !== date('Y-m-d')){
        $err['date'] = "<strong class='text-danger'>Ви вказали не поточну дату.</strong>";
        $flag = 1;
    }
    if(!isset($_POST['publish_in_index'])) {
        $err['publish_in_index'] = "<strong class='text-danger'>Оберіть один із параметрів.</strong>";
        $flag = 1;
    }
    if(!isset($_POST['category'])) {
        $err['category'] = "<strong class='text-danger'>Оберіть один із параметрів.</strong>";
        $flag = 1;
    }
    if($flag == 0) {
        Header('Location:'.$_SERVER['HTTP_REFERER'] ."?mes=success");
    }





}



