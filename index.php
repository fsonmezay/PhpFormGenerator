<?php
  require "./FormGenerator.php";
  // TODO: delete these
  error_reporting(E_ALL);
  ini_set("display_errors", 1);
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
  <link rel="stylesheet" href="./css/custom.css">

</head>

<body>
  <div class="container">
    <?php
    if(isset($_POST)){
      echo "<pre>";
      print_r($_POST);
      echo "</pre>";
    }
    $formGenerator = new FormGenerator();
    $formGenerator->addField("Name", "text", "fieldName", "", "Place this", "sub");
    $formGenerator->addField("Soyisim", "text", "fieldLastName");
    $formGenerator->addField("Şifreniz", "password", "Password", "aabbcc11", "en Az 8 Karakter");
    $formGenerator->addField("Long Text", "textarea", "textarea_11", "Some Text", "Longer description");
    $formGenerator->addField("Dosya Yükleyin", "file", "file_01", "fileyukle",  "sadece psd");
    $formGenerator->addField("Adınız", "text", "name_s_0_1" , "ferdi", "Adınızı yazın", "sadece ilk adınız", true);

    $cities = array(1=>"Adana", 6=>"Ankara", 7=>"Antalya", 16=>"Bursa", 26=>"Eskişehir", 38=>"Kayseri", "yok"=>"yooo");
    $selectedCities=array(1, 7, 26);
    $formGenerator->addField("Şehir", "radio", "city_namer", 1, "", "Current City", true, false, $cities, $selectedCities, true);
    $formGenerator->addField("Şehir", "checkbox", "city_namec", 6, "", "Current City", true, false, $cities, $selectedCities, true);
    $formGenerator->addField("Şehir", "select", "city_names", 1, "", "Current City", true, true, $cities, $selectedCities, true);

    $formGenerator->makeForm("Form Title", "?", $formGenerator->getInputFields(), "Description", "Gönder", "", "POST", "multipart/form-data");

    $formGenerator->display();

   ?>
  </div>
</body>
</html>
