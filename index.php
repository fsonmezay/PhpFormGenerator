<?php
  require "./NewFormGenerator.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="keywords" content="php, form, generator, form generator, php form generator">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="PhpFormGenerator">
  <meta name="author" content="http://www.ferdisonmezay.com">


  <title>Php Form Generator</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
  <style>
    .form-container {
      background-color:#f0f0f0;
      padding:30px;
      margin-top:50px;
    }

  </style>
</head>

<body>
  <div class="container">
    <?php

    $formGenerator = new FormGenerator();
    $formGenerator->addField("İsim", "fieldName", "text", "", "Place this", "sub");
    $formGenerator->addField("Soyisim", "fieldLastName", "text");
    $formGenerator->addField("Şifreniz", "Password", "password", "aabbcc11", "en Az 8 Karakter");
    $formGenerator->addField("Long Text", "textarea_11", "textarea", "Some Text", "Longer description");
    $formGenerator->addField("Dosya Yükleyin", "file_01", "file", "fileyukle",  "sadece psd");
    $formGenerator->addField("Adınız", "name_s_0_1" , "text", "ferdi", "Adınızı yazın", "sadece ilk adınız", true);

    $cities = array(1=>"Adana", 6=>"Ankara", 7=>"Antalya", 16=>"Bursa", 26=>"Eskişehir", 38=>"Kayseri", "yok"=>"yooo");
    $selectedCities=array(7, 26);
    $formGenerator->addField("Şehir", "city_name", "select", 1, "", "Current City", true, false, $cities, $selectedCities, true);

    $formGenerator->makeForm("Form Title", "action.php", $formGenerator->getInputFields(), "Description");

    $formGenerator->display();

   ?>
  </div>
</body>
</html>
