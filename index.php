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
    <link rel="stylesheet" href="assets/css/datepicker.minimal.css">
    <link rel="stylesheet" href="assets/css/datepicker.material.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Форма обратной связи</title>
</head>
<body>
<?php

include "validator.php";

$Validator = new Validator($_POST);

$form_data_exist = boolval(count($_POST));

$name = $_POST['name'] ?? '';
$surname = $_POST['surname'] ?? '';
$email = $_POST['email'] ?? '';
$date = $_POST['date'] ?? '';
$phone = $_POST['phone'] ?? '';
$city = $_POST['city'] ?? '';
$file = $_POST['file'] ?? '';

if ($form_data_exist) {
    $Validator->Expect(key: "name", rule: "required, min_len=3");
    $Validator->Expect(key: "surname", rule: "required, min_len=3");
    $Validator->Expect(key: "email", rule: "required, email, min_len=5");
    $Validator->Expect(key: "date", rule: "required, min_len=10");
    $Validator->Expect(key: "phone", rule: "required, phone");
    $Validator->Expect(key: "city", rule: "required, min_len=3");
    $Validator->Expect(key: "file", rule: "required");
}

$validation_passed = $form_data_exist && $Validator->Validate();
?>
<div class="wrapper">
    <form action="index.php" method="POST" class="form" id="form">
        <div class="form-wrapper">
            <h1>Форма обратной связи</h1>
            <div class="input_wrapper">
                <label for="name" class="label">Имя</label>
                <input type="text" id="name" required class="input" name="name" value="<?= $name ?>">
            </div>
            <div class="input_wrapper">
                <label for="surname" class="label">Фамилия</label>
                <input type="text" id="surname" required class="input" name="surname" value="<?= $surname ?>">
            </div>
            <div class="input_wrapper">
                <label for="email" class="label">Email</label>
                <input type="email" id="email" required class="input" name="email" value="<?= $email ?>">
            </div>
            <div class="input_wrapper">
                <label for="datepicker" class="label">Дата рождения</label>
                <input type="text" id="datepicker" required class="input" name="date" value="<?= $date ?>">
            </div>
            <div class="input_wrapper">
                <label for="phone" class="label">Номер телефона</label>
                <input type="text" id="phone" required placeholder="+7 (___)___-__-__" class="input"
                       name="phone" value="<?= $phone ?>">
            </div>
            <div class="input_wrapper">
                <label for="city" class="label">Город</label>
                <input type="text" id="city" required class="input" name="city" value="<?= $city ?>">
            </div>
            <label for="file" class="label">Портфолио</label>
            <div class="input_wrapper_file">
                <input type="file" id="file" required accept=".doc, .docx, .pdf, .html" class="input input_file"
                       name="file" value="<?= $file ?>">
                <label for="file" class="file_label">
                    <span class="file_label_text">Выберите файл</span>
                </label>
            </div>
            <input
                    type="submit"
                    id="submit_button"
                    value="<?= !$validation_passed ? 'Отправить заявку' : 'Заяка уже отправлена' ?>"
                    class="button <?= !$validation_passed ? '' : 'button_submitted' ?>"
            >
        </div>
    </form>
</div>

<?php if ($form_data_exist): ?>

    <?php if ($validation_passed): ?>
        <div class="popup popup_visible">
            <div class="popup_body">
                <div class="popup_content">
                    <div class="popup_title">Успешно!</div>
                    <div class="popup_text">Ваша заявка принята!</div>
                    <a href="#" class="popup_close">OK</a>
                </div>
            </div>
        </div>

    <?php else: ?>
        <div class="popup popup_visible">
            <div class="popup_body">
                <div class="popup_content">
                    <div class="popup_title">Ошибка!</div>
                    <div class="popup_text">Проверьте правильность заполнения полей!</div>
                    <a href="#" class="popup_close">OK</a>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<script src="https://unpkg.com/just-validate@latest/dist/just-validate.production.min.js"></script>
<script src="assets/js/datepicker.js"></script>
<script src="assets/js/main.js"></script>
</body>
</html>