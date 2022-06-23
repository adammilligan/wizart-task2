<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/reset.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Форма обратной связи</title>
</head>
<body>
<div class="wrapper">
    <form action="index.php" method="POST" class="form" id="form">
        <div class="form-wrapper">
            <h1>Форма обратной связи</h1>
            <div class="input_wrapper">
                <label for="name" class="label">Имя</label>
                <input type="text" id="name" required pattern="[A-Za-zА-Яа-яЁё]{3-15}" class="input" name="name">
            </div>
            <div class="input_wrapper">
                <label for="surname" class="label">Фамилия</label>
                <input type="text" id="surname" required pattern="[A-Za-zА-Яа-яЁё]{3-15}" class="input" name="surname">
            </div>
            <div class="input_wrapper">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" required class="input" name="email">
            </div>
            <div class="input_wrapper">
                <label for="birthday" class="label">Дата рождения</label>
                <input type="date" id="date" required class="input" name="date">
            </div>
            <div class="input_wrapper">
                <label for="phone" class="label">Номер телефона</label>
                <input type="text" id="phone" required placeholder="+7 (___)___-__-__" pattern="[0-9]{11}" class="input"
                       name="phone">
            </div>
            <div class="input_wrapper">
                <label for="city" class="label">Город</label>
                <input type="text" id="city" required pattern="[A-Za-zА-Яа-яЁё]{3-15}" class="input" name="city">
            </div>
            <label for="file" class="label">Портфолио</label>
            <div class="input_wrapper_file">
                <input type="file" id="file" required accept=".doc, .docx, .pdf, .html" class="input input_file"
                       name="file">
                <label for="file" class="file_label">
                    <span class="file_label_text">Выберите файл</span>
                </label>
            </div>
            <input type="submit" value="Отправить заявку" id="submit_button" class="button">
        </div>
    </form>
    <div class="popup">
        <div class="popup_body">
            <div class="popup_content">
                <div class="popup_title">Успешно!</div>
                <div class="popup_text">Ваша заявка принята!</div>
                <a href="#" class="popup_close">OK</a>
            </div>
        </div>
    </div>
</div>


<?php

include "validator.php";

$form_data_exist = isset($_POST) && count($_POST);

if ($form_data_exist){
    print_r($_POST);
}

if ($form_data_exist){
    $Validator = new Validator($_POST);

    $Validator=>Expect(key:"name", rule:"required, min=3");
    $Validator=>Expect(key:"surname", rule:"required, min=3");
    $Validator=>Expect(key:"email", rule:"required, email, min=5");
    $Validator=>Expect(key:"birthday", rule:"required, min=10");
    $Validator=>Expect(key:"phone", rule:"required, min=10");
    $Validator=>Expect(key:"city", rule:"required, min=3");
    $Validator=>Expect(key:"file", rule:"required");

    if ($Validator=>Validate()){
        echo "Validation ok";
    } else {
        echo "Validation failed";
    }

}
?>

<?php if ($form_data_exist): ?>

    <?php if (isset($Validator) && $Validator=>Validate()): ?>
        <p>
            Форма отправлена!
        </p>

    <?php else: ?>

        <p>
            Серверная валидация не пройдена
        </p>
    <?php endif; ?>

<?php endif; ?>




<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
<script src="assets/js/just-validate-plugin-date.production.min.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>