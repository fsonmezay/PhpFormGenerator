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
      print_r($_FILES);
      echo "</pre>";
    }
    $form = new FormGenerator();

    $cities = array(1=>"Adana", 6=>"Ankara", 7=>"Antalya", 16=>"Bursa", 26=>"Eskişehir", 38=>"Kayseri", "yok"=>"yooo");
    $selectedCities=array(1, 7, 26);

    $form->addSelect("City", "city_id", $cities, array(),  7, "Choose your current city!", true, true);
    $form->addRadio("Şehir Radio", "city_nameradio", "", "", true, $cities, array(6,16));
    $form->addCheckbox("Şehir Check", "city_namecheck", 7, "", false, $cities, array(6));
    $form->addText("NameText", "textfieldName", "11", "Place this", "subliminall", true);
    $form->addTextarea("NameTextArea", "textareafieldName", "", "Place this", "subliminall", false);
    $form->addHidden("hiddenName", "11");

    $form->addField("Name", "text", "fieldName", "", "Place this", "subliminall");
    $form->addField("Soyisim", "text", "fieldLastName");
    $form->addField("Şifreniz", "password", "Password", "aabbcc11", "en Az 8 Karakter");
    $form->addField("Long Text", "textarea", "textarea_11", "Some Text", "", "Longer description",true);
    $form->addField("Dosya Yükleyin", "file", "file_01", "fileyukle",  "sadece psd");
    $form->addField("Adınız", "text", "name_s_0_1" , "ferdi", "Adınızı yazın", "sadece ilk adınız", true);


    $form->addField("Şehir", "radio", "city_namer", 1, "", "Current City", false, false, $cities, $selectedCities);
    $form->addField("Şehir", "checkbox", "city_namec", 6, "", "Current City", false, false, $cities, $selectedCities);
    $form->addField("Şehir", "select", "city_names", "", "", "", false, false, $cities, $selectedCities, true);


    $form->makeForm("Form Title", "?", $form->getInputFields(), "Description", "Gönder", "", "POST", "multipart/form-data");

    $form->display();

   ?>
  </div>
</body>
</html>
