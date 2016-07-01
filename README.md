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

Hidden field creation is very simple. The definition of function is as follows 

```php
 $form->addHidden();
```
