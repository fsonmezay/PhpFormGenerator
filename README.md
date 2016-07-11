# PhpFormGenerator

Simplest php form generator ever.

This library generates [Bootstrap 3.x](http://getbootstrap.com/)  compatible html forms.

## Getting Started

You need to add FormGenerator.php file to your project with the following code:
```php
<?php
  require "FormGenerator.php";
?>
```

Then create an instance of this class:
```php
<?php
  $form = new FormGenerator();
?>
```

And you must call `makeForm()` function after you initialize the form fields explained below.

`makeForm()` function definition is as follows

```php
<?php  
public function makeForm(
  $label,
  $action,
  $inputFields, # array of input fields
  $description = "",
  $buttonText = "Submit",
  $buttonValue = 0,
  $method = "GET",
  $enctype = "application/x-www-form-urlencoded",
  $displayCapthca = false,  # will be implemented
  $isDisabled = false);
?>
```

sample call for this function is :
```php
<?php
  $form->makeForm("Sample form title", "form-submit-action.php", $form->getInputFields());
?>
```
**__Note__** Remember to create input fields first. 

You can add html form fields using the functions explained below.

### Select

Here is the definition of `addselect()` function

```php
<?php
public function addSelect(
  $label,
  $name,
  $itemList = array(),
  $selectedItems = array(),
  $description="",
  $isDisabled=false,
  $isMultiSelectable = false,
  $pleaseSelectEnabled = true);
?>
```

There are only two required parameters, all other are optional. Let's say we have an array of cities defined as follows:

```php
<?php
$cities = array(1=>"Istanbul",
                2=>"Athens",
                3=>"Sofia",
                4=>"Moscow",
                5=>"Prague",
                6=>"Barcelona");
?>
```

Now let's create an html select item filled with city names given in `$cities` array

```php
<?php
$form->addSelect("Select Your Favourite City", "city", cities);
?>
```

The output will be as follows
```html
<div class="form-group">
   <label class="control-label" for="city">Select Your Favourite City</label>
   <select name="city" class="form-control">
      <option value="null"> -- Please Select --</option>
      <option value="1">Istanbul</option>
      <option value="2">Athens</option>
      <option value="3">Sofia</option>
      <option value="4">Moscow</option>
      <option value="5">Prague</option>
      <option value="6">Barcelona</option>
   </select>
</div>
```

If you want some items selected, you can set `$selectedItems` .

For instance
 - if you want Istanbul selected you must set ` $selectedItems = new array(1)`
 - if you want Athens and Barcelona selected you can set ` $selectedItems = new array(2,6)`
  - **Note**: you must set `$isMultiSelectable = true` to see multiple selected items.

### Text / Password / Hidden / File fields

**Hidden Field**

Hidden field creation is very simple. you must only set the field name, and value.

```php
 // $form->addHidden($name, $value);
 $form->addHidden("my_hidden_field", "Hidden Value");
```

And the output value will be

```html
<div class="form-group">
  <label class="control-label" for="my_hidden_field"></label>
  <input value="Hidden Value" name="my_hidden_field" id="my_hidden_field" placeholder="" class="form-control" aria-describedby="my_hidden_field-help" type="hidden">
</div>
```

**Text field**

Text fields are most commonly used elements in html forms. the definition of `addText()` function is as follows.

```php
<?php
  public function addText(
    $label,
    $name,
    $value="",
    $placeholder="",
    $description="",
    $isDisabled=false);
 ?>
 ```

 **$label** and **$name** parameters are required. Others are optional.

Create a text field

```php
<?php
  $form->addText("Your Username", "username");
?>
```

**Output**
```html
<div class="form-group">
  <label class="control-label" for="username">Your Username</label>
  <input value="" name="username" id="username" placeholder="" class="form-control" aria-describedby="username-help" type="text">
</div>
```

Create a text field with initial value

```php
<?php
  $form->addText("Your Username", "username", "fsonmezay");
?>
```

**Output**
```html
<div class="form-group">
    <label class="control-label" for="username">Your Username</label>
    <input value="fsonmezay" name="username" id="username" placeholder="" class="form-control" aria-describedby="username-help" type="text">
</div>
```


 If you want to make the text field disabled, just set `$isReadOnly = true`;

 Here is sample call for disabled text field.

 ```php
 <?php
  $form->addText("Your Username", "username", "fsonmezay", "", "Your Unique username", true);
 ?>
 ```

 **Output**
 ```html
 <div class="form-group">
     <label class="control-label" for="username">Your Username</label>
     <input value="fsonmezay" name="username" id="username" placeholder="" class="form-control" disabled="" aria-describedby="username-help" type="text" />
   	<span id="username-help" class="help-block">Your Unique username</span>
 </div>
 ```

 **Password and File fields**

 Function descriptions of password and file fields are same as the text field.

 **addPassword() definition**

 ```php
 <?php
   public function addPassword(
     $label,
     $name,
     $value="",
     $placeholder="",
     $description="",
     $isDisabled=false);
  ?>
  ```

  **addFile() definition**

  ```php
  <?php
    public function addFile(
      $label,
      $name,
      $description="",
      $isDisabled=false);
   ?>
   ```

### Textarea

Textarea function definition is as follows
```php
<?php
public function addTextarea(
    $label,
    $name,
    $value="",
    $placeholder="",
    $description="",
    $isDisabled=false);
?>
```

Creating a textarea is same as text fields. You must set `$label`and `$name` parameters, which are required. You can also set `$value` parameter to set initial textarea value.

Here is a sample call for textarea
```php
<?php
  addTextarea("Long Text", "long-text", "This is initial value");
?>
```

**Output**
```html
<div class="form-group">
    <label class="control-label" for="long-text">Long Text</label>
    <textarea id="long-text" name="long-text" class="form-control" rows="4" placeholder="">This is initial value</textarea>
</div>

```
### Radio and Checkbox

Let's say we have an array of cities defined as follows:

```php
<?php
$cities = array(1=>"Istanbul",
                2=>"Athens",
                3=>"Sofia",
                4=>"Moscow",
                5=>"Prague",
                6=>"Barcelona");
?>
```
We will use this array to create radio and checkbox fields.

**Radio**

`addRadio()` function definition is as follows

```php
<?php
public function addRadio(
  $label,
  $name,
  $itemList = array(),
  $selectedItem="",
  $description="",
  $isDisabled=false);
?>
```

You need to specify first three parameters to create radio fields. So here's a sample call for `addRadio()` function:

```php
<?php
  addRadio("Radio minimal", "radio-minimal", $cities);
?>
```

**Output**
```html
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label class="control-label" for="radio-minimal">Radio minimal</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="radio ">
                <label>
                    <input value="1" name="radio-minimal" type="radio">Istanbul</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="2" name="radio-minimal" type="radio">Athens</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="3" name="radio-minimal" type="radio">Sofia</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="4" name="radio-minimal" type="radio">Moscow</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="5" name="radio-minimal" type="radio">Prague</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="6" name="radio-minimal" type="radio">Barcelona</label>
            </div>
        </div>
    </div>
</div>
```

If you want an item selected you must set `$selectedItem` parameter. For instance
If you want to set Moscow selected then function call must be as follows:

```php
<?php
  addRadio("Radio Selected", "radio-selected", $cities, 4);
?>
```

than the output will be

```html
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label class="control-label" for="radio-selected">Radio With Selection</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="radio ">
                <label>
                    <input value="1" name="radio-selected" type="radio">Istanbul</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="2" name="radio-selected" type="radio">Athens</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="3" name="radio-selected" type="radio">Sofia</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="4" name="radio-selected" checked="checked" type="radio">Moscow</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="5" name="radio-selected" type="radio">Prague</label>
            </div>
            <div class="radio ">
                <label>
                    <input value="6" name="radio-selected" type="radio">Barcelona</label>
            </div>
        </div>
    </div>
</div>
```

**Checkbox**

`addCheckbox()` function definition is as follows

```php
<?php
public function addCheckbox(
  $label,
  $name,
  $itemList = array(),
  $selectedItems = array(),
  $description="",
  $isDisabled=false);
?>
```

You need to specify first three parameters to create checkbox fields. So here's a sample call for `addCheckbox()` function:

```php
<?php
  addCheckbox("Checkbox minimal", "checkbox-minimal", $cities);
?>
```

**Output**
```html
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label class="control-label" for="checkbox-minimal">Checkbox minimal</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="checkbox ">
                <label>
                    <input value="1" name="checkbox-minimal[]" type="checkbox">Istanbul</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="2" name="checkbox-minimal[]" type="checkbox">Athens</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="3" name="checkbox-minimal[]" type="checkbox">Sofia</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="4" name="checkbox-minimal[]" type="checkbox">Moscow</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="5" name="checkbox-minimal[]" type="checkbox">Prague</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="6" name="checkbox-minimal[]" type="checkbox">Barcelona</label>
            </div>
        </div>
    </div>
</div>
```

If you want some items selected you must set `$selectedItems` parameter. For instance
If you want to set Athens and Moscow selected then function call must be as follows:

```php
<?php
  $selectedItems = array(4,6);
  addCheckbox("Checkbox with Selection", "checkbox-selected", $cities, $selectedItems);
?>
```

than the output will be

```html
<div class="form-group">
    <div class="row">
        <div class="col-md-12">
            <label class="control-label" for="checkbox-selected">Checkbox With Selection</label>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="checkbox ">
                <label>
                    <input value="1" name="checkbox-selected[]" type="checkbox">Istanbul</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="2" name="checkbox-selected[]" checked="checked" type="checkbox">Athens</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="3" name="checkbox-selected[]" type="checkbox">Sofia</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="4" name="checkbox-selected[]" checked="checked" type="checkbox">Moscow</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="5" name="checkbox-selected[]" type="checkbox">Prague</label>
            </div>
            <div class="checkbox ">
                <label>
                    <input value="6" name="checkbox-selected[]" type="checkbox">Barcelona</label>
            </div>
        </div>
    </div>
</div>
```
