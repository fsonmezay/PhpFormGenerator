# PhpFormGenerator

Easily generate html forms with php

```
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

```
