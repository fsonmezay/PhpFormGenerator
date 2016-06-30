<?php
class FormGenerator {
  private $inputFields = array();
  private $form;

  public function makeForm($title, $action, $inputFields,
                           $description = "", $buttonText = "Submit", $buttonValue = 0,
                           $method = "GET", $enctype = "application/x-www-form-urlencoded",
                           $displayCapthca = false, $isReadOnly = false) {
    $this->form = new Form($title, $action, $inputFields, $description,
                           $buttonText, $buttonValue, $method, $enctype,
                           $displayCapthca, $isReadOnly);
  }

  public function addField($title, $type, $name, $value = "", $placeholder = "",
                           $description = "", $isReadOnly = false,
                           $isMultiSelectable = false, $itemList = array(),
                           $selectedItems = array(), $pleaseSelectEnabled = true) {
    $this->inputFields[] = new InputField($title, $type, $name, $value, $placeholder,
                                          $description, $isReadOnly, $isMultiSelectable,
                                          $itemList, $selectedItems,
                                          $pleaseSelectEnabled);
  }

  public function getInputFields() {
    return $this->inputFields;
  }

  public function getForm() {
    return $this->form;
  }

  public function display(){
    echo $this->form->getHtml();
	}


}

// html form elmeent
class Form {

  // required parameters
  private $title;
  private $action;
  private $inputFields = array(); // array of InputField Objects

  // non required and default value params
  private $description;
  private $buttonText = "Submit";
  private $buttonValue = 0;

  private $method = "GET";
  private $enctype = "application/x-www-form-urlencoded";

  private $displayCapthca = false;
  private $isReadOnly = false;

  // construct form
  public function __construct($title, $action, $inputFields,
                              $description = "", $buttonText = "Submit", $buttonValue = 0,
                              $method = "GET", $enctype = "application/x-www-form-urlencoded",
                              $displayCapthca = false, $isReadOnly = false) {

    // input fields should be specified
    if(!is_array($inputFields) || sizeof($inputFields) < 1 ) {
      return false;
    }

    $this->title = $title;
    $this->action = $action;
    $this->inputFields = $inputFields;

    $this->description = $description;
    $this->buttonText  = $buttonText;
    $this->buttonValue = $buttonValue;
    $this->method = $method;
    $this->enctype = $enctype;
    $this->displayCapthca = $displayCapthca;
    $this->isReadOnly = $isReadOnly;

  }

  public function getHtml() {
    $result = '<div class="form-container">';
    $result .= '<form method="'.$this->method.'" action="'.$this->action.'" enctype="'.$this->enctype.'">';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12">';
    $result .= '<h3>'.$this->title.'</h3>';
    $result .= '<p>'.$this->description.'</p>';
    $result .= '</div>';
    $result .= '</div>';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12">';

    foreach($this->inputFields as $key => $val) {
      $result .= $val->getHtml();
    }

    $result .= '</div>';
    $result .= '</div>';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12 text-right">';
    $result .= '<input type="submit" class="btn btn-info" value="'.$this->buttonText.'" /></div>';
    $result .= '</div>';
    $result .= '</form>';
    $result .= '</div>';
    return $result;
  }

}

class InputField{

  // parameters
  private $title;
  private $name;
  private $type;
  private $value; // selected value for select, radio, checkbox
  private $placeholder = "";
  private $description;
  private $isReadOnly = false;
  private $isMultiSelectable = false;
  private $itemList = array(); // ($key=>value)
  private $selectedItems = array(); // $key
  private $pleaseSelectEnabled = true;

  // construct with all parameters
  public function __construct($title, $type, $name, $value = "", $placeholder = "",
                              $description = "", $isReadOnly = false,
                              $isMultiSelectable = false, $itemList = array(),
                              $selectedItems = array(), $pleaseSelectEnabled = true) {
    $this->title = $title;
    $this->type = $type;
    $this->name = $name;
    $this->value = $value;
    $this->placeholder = $placeholder;
    $this->description = $description;
    $this->isReadOnly = $isReadOnly;
    $this->isMultiSelectable = $isMultiSelectable;
    $this->itemList = $itemList;
    $this->selectedItems = $selectedItems;
    $this->pleaseSelectEnabled = $pleaseSelectEnabled;
  }

  // return html of form field
  public function getHtml(){
    $result = '<div class="form-group">'; // validation class will be here
    $result .= $this->getFieldHtmlByType($this->type);
    $result .= '</div>';

    return $result;
  }

  //
  private function getFieldHtmlByType($type){
    $result = "";
    if($this->isInput($type)) {
      $result .= $this->getCommonLabelForField();
      $result .= '<input value="'.$this->value.'" name="'.$this->name.'" id="'.$this->name.'" type="'.$type.'" placeholder="'.$this->placeholder.'" class="form-control" '.$this->getDisableOption().' aria-describedby="'.$this->name.'-help"/>';
      $result .= $this->getCommonDescriptionForField();
    }

    else if($this->isTextarea($type)) {
      $result .= $this->getCommonLabelForField();
      $result .= '<textarea id="'.$this->name.'" name="'.$this->name.'" class="form-control" rows="4" placeholder="'.$this->placeholder.'"  '.$this->getDisableOption().'>'.$this->value.'</textarea>';
      $result .= $this->getCommonDescriptionForField();
    }

    else if ($this->isCheckboxOrRadio($type)) {
      $result .= $this->addValueToSelectedItems($this->value);
      $result .= '<div class="row">';
      $result .= '<div class="col-md-12">';
      $result .= $this->getCommonLabelForField();
      $result .= '</div>';
      $result .= '</div>';

      $result .= '<div class="row">';
      $result .= '<div class="col-md-12">';
      $result .= $this->getCheckboxOrRadioOptions($type);
      $result .= '</div>';
      $result .= '</div>';

      $result .= $this->getCommonDescriptionForField();
    }

    else if($this->isSelect($type)) {
      $this->addValueToSelectedItems($this->value);
      $multiSelectText = "";
      $namePostfix = "";
      if($this->isMultiSelectable) {
        $multiSelectText = 'MULTIPLE size="6"';
        if($this->isCheckbox($type)) {
          $namePostfix = "[]";
        }
      }

      $result .= $this->getCommonLabelForField();
      $result .= '<select name="'.$this->name.''.$namePostfix.'" class="form-control" '.$multiSelectText.'>';
      $result .= $this->getSelectOptions();
      $result .= '</select>';
      $result .= $this->getCommonDescriptionForField();
    }

    else if($this->isDatetimePicker($type)) {
      $result .=  $this->getCommonLabelForField();
    }

    return $result;
  }

  private function getCommonLabelForField() {
    return '<label class="control-label" for="'.$this->name.'">'.$this->title.'</label>';
  }

  private function getCommonDescriptionforField() {
    if(strlen($this->description) > 0) {
      return '<span id="'.$this->name.'-help" class="help-block">'.$this->description.'</span>';
    }
  }

  private function addValueToSelectedItems($value){
    if(strlen($value) > 0) {
      $this->selectedItems[] = $value;
    }
  }

  private function getSelectOptions() {
    $result = "";
    if($this->pleaseSelectEnabled) {
      $result .= '<option value="null"> -- Please Select --</option>';
    }

    foreach($this->itemList as $key => $val) {
      $selectedText = "";
      if(in_array($key, $this->selectedItems)) {
        $selectedText = 'selected="selected"';
      }
      $result .= '<option value="'.$key.'" '.$selectedText.'>'.$val.'</option>';
    }
    return $result;
  }

  //get items for checkboz or radio
  private function getCheckboxOrRadioOptions($type) {
    $result = "";
    $namePostfix = "";
    if($this->isCheckbox($type)) {
      $namePostfix = "[]";
    }

    foreach($this->itemList as $key => $val) {
      $selectedText = "";
      if(in_array($key, $this->selectedItems)) {
        $selectedText = 'checked="checked"';
      }
      $result .= '<div class="'.$type.'">';
      $result .= '<label>';
      $result .= '<input type="'.$type.'" value="'.$key.'" name="'.$this->name.''.$namePostfix.'" '.$selectedText.' />' . $val;
      $result .= '</label>';
      $result .= '</div>';
    }
    return $result;
  }

  private function isInput($type) {
    $result = false;
    if( !strcmp($type, InputFieldType::TEXT) ||
        !strcmp($type, InputFieldType::PASSWORD) ||
        !strcmp($type, InputFieldType::HIDDEN) ||
        !strcmp($type, InputFieldType::FILE)
      ) {
      $result = true;
    }

    return $result;
  }

  private function isCheckboxOrRadio($type) {
    $result = false;
    if( !strcmp($type, InputFieldType::RADIO) ||
        !strcmp($type, InputFieldType::CHECKBOX)
      ) {
      $result = true;
    }

    return $result;
  }

  private function isCheckbox($type) {
    return (!strcmp($type, InputFieldType::CHECKBOX));
  }

  private function isTextarea($type) {
    return (!strcmp($type, InputFieldType::TEXTAREA));
  }

  private function isSelect($type) {
    return (!strcmp($type, InputFieldType::SELECT));
  }

  private function isDatetimePicker($type) {
    return (!strcmp($type, InputFieldType::DATETIMEPICKER));
  }

  private function getDisableOption() {
    return ($this->isReadOnly ? ' disabled' : '');
  }

}

// define input types
abstract class InputFieldType {

  //HTML input constants
	const TEXT = "text";
	const PASSWORD = "password";
	const HIDDEN = "hidden";
  const FILE = "file";

  const RADIO = "radio";
	const CHECKBOX = "checkbox";

  const TEXTAREA = "textarea";
	const SELECT = "select";

	const DATETIMEPICKER = "dateTimePicker";

}
?>
