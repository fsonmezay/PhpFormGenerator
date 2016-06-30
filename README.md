# PhpFormGenerator

Easily generate html forms with php.

## Getting Started

You need to add FormGenerator.php file to your project with the following code:
```
<?php
  require "FormGenerator.php";
?>
```

Then create an instance of this class:
```
<?php
  $form = new FormGenerator();
?>
```

You can add html form fields using the functions explained below.

### Select

Create a select with minimal and default parameters:
```
<?php
$form->addSelect($title, $fieldName);
// $form->addSelect("Choose Your City", "city");
?>
```
This code will create an html select element with a " -- Please Select --" option.

To fill this select we will use the array below.
```
<?php
$cities = array(1=>"Istanbul", 2=>"Athens", 3=>"Sofia", 4=>"Moscow", 5=>"Prague", 6=>"Barcelona");
?>
```

And here is how you create a non-empty html select element:
```
<?php
$cities = array(1=>"Istanbul", 2=>"Athens", 3=>"Sofia", 4=>"Moscow", 5=>"Prague", 6=>"Barcelona");
$form->addSelect($title, $fieldName, $valueArray);
// $form->addSelect("Choose Your City", "city", $cities);
?>
```
