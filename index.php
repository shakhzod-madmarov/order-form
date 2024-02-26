<?php

$nameErr = $phoneErr = "";

$userName = $phoneNumber = "";

$validation = "ok";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    function checkingData($data){
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

     $phoneValidation = preg_match("/^\+7\(\d{3}\)\d{3}-\d{2}-\d{2}$/", $_POST["phoneNumber"]);

    if (empty($_POST["userName"])) {
        $nameErr = "Пожалуйста, введите свое имя.";
        $validation = "no";
    } else{
        $userName = checkingData($_POST["userName"]);
    }

    if(empty( $_POST["phoneNumber"] )){
        $phoneErr = "Пожалуйста, введите свой номер телефона";
        $validation = "no";
    } elseif(!$phoneValidation){
        $phoneErr = "Пожалуйста, введите свой номер телефона в правильном формате";
    } else{
      $phoneNumber = checkingData($_POST["phoneNumber"]);

    }

    if($validation=="ok"){
          header("Location: success.php");
        exit;
    } else {
        header("Location: error.php");
        exit;
    }
    
}

?>


<!DOCTYPE html>
<html lang="ru">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Форма для заказа</title>
        <link rel="stylesheet" href="styles.css" />
    </head>

    <body>
        <main class="main">
            <section class="order">
                <h1 class="order-title">Заполните Форму для заказа</h1>
                <form action="<?php 
                  echo htmlspecialchars($_SERVER["PHP_SELF"]); 
                ?>" class="order__form form" method="post">
                    <label for="userName">Имя</label>
                    <span><?php echo isset($nameErr) ?  $nameErr : ""  ?></span>
                    <input type="text" placeholder="Напиши своё имя" id="userName" class="form__input--name"
                        name="userName" value="<?php
                        if($userName??null){
                      echo htmlentities($userName);
                    }
                    ?>" />
                    <label for="phoneNumber">Номер телефона</label>
                    <span><?php echo isset($phoneErr) ? $phoneErr : "" ?></span>
                    <input type="tel" id="phoneNumber" class="form__input--phone"
                        placeholder="Напиши свой номер телефона" name="phoneNumber" value="<?php
                        if($phoneNumber??null){
                      echo htmlentities($phoneNumber);
                    }
                    ?>" />
                    <input type="submit" value="Заказать" class="form__input--submit" />
                </form>
            </section>
        </main>
    </body>

</html>