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
  $isReadOnly=false,
  $isMultiSelectable = false,
  $pleaseSelectEnabled = true
  )
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

#### Hidden field

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

#### Text field

Text fields are most commonly used elements in html forms. the definition of `addText()` function is as follows.

```php
<?php
  public function addText(
    $label,
    $name,
    $value="",
    $placeholder="",
    $description="",
    $isReadOnly=false);
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

 #### Password and File fields

 Function descriptions of password and file fields are same as the text field.

 ##### Password function definition

 ```php
 <?php
   public function addPassword(
     $label,
     $name,
     $value="",
     $placeholder="",
     $description="",
     $isReadOnly=false);
  ?>
  ```

  ##### File function definition

  ```php
  <?php
    public function addFile(
      $label,
      $name,
      $value="",
      $placeholder="",
      $description="",
      $isReadOnly=false);
   ?>
   ```
