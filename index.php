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
    $cities = array(1=>"Istanbul", 2=>"Athens", 3=>"Sofia", 4=>"Moscow", 5=>"Prague", 6=>"Barcelona");
    $selectedCities = array();

    $textFieldForm = new FormGenerator();
    $textFieldForm->addText("Minimal text field", "text-minimal");
    $textFieldForm->addText("Text field with initial value", "text-initial", "Text Field Value");
    $textFieldForm->addText("Text field with placeholder", "text-placeholder", "", "This is placeholder");
    $textFieldForm->addText("Text field with description", "text-description", "", "", "This is description");
    $textFieldForm->addText("Disabled text field", "text-disabled", "Some Value", "This is placeholder", "", true);
    $textFieldForm->makeForm("Text Fields Demo Form", "?", $textFieldForm->getInputFields(), "", "Submit", "", "POST", "multipart/form-data");

    $passwordFieldForm = new FormGenerator();
    $passwordFieldForm->addPassword("Minimal password", "password-minimal");
    $passwordFieldForm->addPassword("Password with initial value", "password-initial", "initialValue");
    $passwordFieldForm->addPassword("Password with placeholder", "password-placeholder", "", "Password Placeholder");
    $passwordFieldForm->addPAssword("Password with description", "password-description", "", "", "This is password description");
    $passwordFieldForm->addPassword("Disabled password field", "password-disabled", "initialPasswordValue", "", "", true);
    $passwordFieldForm->makeForm("Password Fields Demo Form", "?", $passwordFieldForm->getInputFields(), "Password Form Description", "Submit Password", "", "POST", "multipart/form-data");

    /* HIDDEN FIELD
    $hiddendFieldForm = new FormGenerator();
    $hiddendFieldForm->addHidden("Minimal Hidden", "password-minimal");
    $hiddendFieldForm->makeForm("Hidden Field Demo Form", "?", $hiddendFieldForm->getInputFields(), "Password Form Description", "Submit Password", "", "POST", "multipart/form-data");
    */

    $fileFieldForm = new FormGenerator();
    $fileFieldForm->addFile("File Minimal", "file-minimal");
    $fileFieldForm->addFile("File With Description", "file-description", "Description");
    $fileFieldForm->addFile("File ReadOnly", "file-readonly", "", true);
    $fileFieldForm->makeForm("File Fields Demo Form", "?", $fileFieldForm->getInputFields(), "File Form Description", "Submit File", "", "POST", "multipart/form-data");

    $textareaForm = new FormGenerator();
    $textareaForm->addTextarea("Textarea Minimal", "textarea-minimal");
    $textareaForm->addTextarea("Textarea With Initial Value", "textarea-initial-value", "Hello Textarea");
    $textareaForm->addTextarea("Textarea With Placeholder", "textarea-placeholder", "", "This is textarea placeholder");
    $textareaForm->addTextarea("Textarea With Description", "textarea-description", "", "", "Textarea Description");
    $textareaForm->addTextarea("Textarea Readonly", "textarea-readonly", "", "", "", true);
    $textareaForm->makeForm("Textarea Demo Form", "?", $textareaForm->getInputFields(), "File Form Description", "Submit File", "", "POST", "multipart/form-data");

    $selectFieldForm = new FormGenerator();
    $selectFieldForm->addSelect("Select Minimal", "select-minimal", $cities);
    $selectFieldForm->addSelect("Select With Selected Item", "select-selecteditem", $cities, array(1));
    $selectFieldForm->addSelect("Select With Description", "select-description", $cities, array(), "This is Select Description");
    $selectFieldForm->addSelect("Select Readonly", "select-readonly", $cities, array(2), "", true);
    $selectFieldForm->addSelect("Select Multiple Selection", "select-multiselect", $cities, array(2, 4), "", false, true);
    $selectFieldForm->addSelect("Select Without 'Please Select' Option", "select-pleaseSelect", $cities, array(), "", false, false, false);
    $selectFieldForm->makeForm("Select Demo Form", "?", $selectFieldForm->getInputFields(), "Select Demo Form Description", "Submit Select", "", "POST", "multipart/form-data");

    $radioForm = new FormGenerator();
    $radioForm->addRadio("Radio minimal", "radio-minimal", $cities);
    $radioForm->addRadio("Radio With Selection", "radio-selected", $cities, 4);
    $radioForm->addRadio("Radio With Description", "radio-description", $cities, 3, "Radio description");
    $radioForm->addRadio("Radio Readonly", "radio-readonly", $cities, 2, "", true);
    $radioForm->makeForm("Radio Demo Form", "?", $radioForm->getInputFields(), "Radio Demo Form Description", "Submit Radio", "", "POST", "multipart/form-data");

    $checkBoxForm = new FormGenerator();
    $checkBoxForm->addCheckbox("Checkbox minimal", "radio-minimal", $cities);
    $checkBoxForm->addCheckbox("Checkbox With Selection", "radio-selected", $cities, array(2,4));
    $checkBoxForm->addCheckbox("Checkbox With Description", "radio-description", $cities, array(3,4), "Checkbox description");
    $checkBoxForm->addCheckbox("Checkbox Readonly", "radio-readonly", $cities, array(2), "", true);
    $checkBoxForm->makeForm("Checkbox Demo Form", "?", $checkBoxForm->getInputFields(), "Checkbox Demo Form Description", "Submit Radio", "", "POST", "multipart/form-data");

   ?>
  </div>
</body>
</html>
