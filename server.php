  <?php
    $theme = "Без темы";
    $useremail = "Не указан";
    $youremail = "marina@localhost.localdomain";
    $name = "посетителя сайта";
    $text = "";
    $useremail = "xxx@xxxx.xx";
   // if(isset($_POST['theme'])) $theme = $_POST['theme'];
   // if(isset($_POST['name'])) $name = $_POST['name']; 
    if(isset($_POST['tel'])) $tel = $_POST['tel'];
    if (isset($_POST['email'])) $useremail = trim(strip_tags($_POST['email']));
   // if (isset($_POST['text'])) $text = $_POST['text'];

    //чистим от html тегов и лишних пробелов:
    $tel = trim(strip_tags($_POST['tel']));
   // $useremail = trim(strip_tags($_POST['email']));

    // Проверка того, что есть данные из капчи
if (!$_POST["g-recaptcha-response"]) {
    // Если данных нет, то программа останавливается и выводит ошибку
    exit("Произошла ошибка");
} else { // Иначе создаём запрос для проверки капчи
    // URL куда отправлять запрос для проверки
    $url = "https://www.google.com/recaptcha/api/siteverify";
    // Ключ для сервера
    $key = "*********";
    // Данные для запроса
    $query = array(
        "secret" => $key, // Ключ для сервера
        "response" => $_POST["g-recaptcha-response"], // Данные от капчи
        "remoteip" => $_SERVER['REMOTE_ADDR'] // Адрес сервера
    );
 
    // Создаём запрос для отправки
    $ch = curl_init();
    // Настраиваем запрос 
    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
    curl_setopt($ch, CURLOPT_POST, true); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $query); 
    // отправляет и возвращает данные
    $data = json_decode(curl_exec($ch), $assoc=true); 
    // Закрытие соединения
    curl_close($ch);
 
    // Если нет success то
    if (!$data['success']) {
        // Останавливает программу и выводит "ВЫ РОБОТ"
        exit("ВЫ РОБОТ");
    } else {
        // Иначе выводим логин и Email
       /* echo $_POST['tel'] . "<br/>". 
             $_POST['email'];*/
          
    }
}
  
    $subject = $theme;
    $header = "Content-type: text/html; charset=\"utf-8\"\r\n";
    $header="From: $name <$useremail>\r\n\r\n";
            
    $message = "Вам пришло сообщение от, $tel!\n Текст сообщения: $text";
     if (mail($youremail, $subject, $message, $header))
            echo "Спасибо, мы свяжемся с Вами в ближайшее время!";
      else
          echo "Сообщение не доставлено попытайтесь еще раз!";     
    
  ?>
  /*6Leyo4saAAAAADK3Dk6v0PU_OeHS1gmDSVMp4HCn 
  /*6Leyo4saAAAAAKjmZBtZnzv08D-CPP6-eOW8JoKo
