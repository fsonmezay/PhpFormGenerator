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

  public function addField($title, $name, $type, $value = "", $placeholder = "",
                           $description = "", $isReadOnly = false,
                           $isMultiSelectable = false, $itemList = array(),
                           $selectedItems = array(), $pleaseSelectEnabled = true) {
    $this->inputFields[] = new InputField($title, $name, $type, $value, $placeholder,
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

  // return object as array
  /*private function asArray() {
    $result = array();

    $result["title"] = $this->title;
    $result["action"] = $this->action;
    $result["inputFields"] = array();
    foreach($this->inputFields as $key => $val) {
      $result["inputFields"][] = $val->asArray();
    }
    $result["description"] = $this->description;
    $result["buttonText"] = $this->buttonText;
    $result["buttonValue"] = $this->buttonValue;
    $result["method"] = $this->method;
    $result["enctype"] = $this->enctype;
    $result["displayCapthca"] = $this->displayCapthca;
    $result["isReadOnly"] = $this->isReadOnly;

    return $result;
  }*/

  public function getHtml() {
    $result = '<div class="form-container">';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12">';
    $result .= '<h3>'.$this->title.'</h3>';
    $result .= '<p>'.$this->description.'</p>';
    $result .= '</div>';
    $result .= '</div>';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12">';
    $result .= '<form method="'.$this->method.'" action="'.$this->action.'" enctype="'.$this->enctype.'">';

    foreach($this->inputFields as $key => $val) {
      $result .= $val->getHtml();
    }

    $result .= '</form>';
    $result .= '</div>';
    $result .= '</div>';
    $result .= '<div class="row">';
    $result .= '<div class="col-md-12 text-right">';
    $result .= '<input type="submit" class="btn btn-info" value="'.$this->buttonText.'" /></div>';
    $result .= '</div>';
    $result .= '</div>';
    return $result;
  }

}

class InputField{

  // parameters
  private $title;
  private $name;
  private $type;
  private $value; // can be array or single value
  private $placeholder = "";
  private $description;
  private $isReadOnly = false;

  private $isMultiSelectable = false;

  private $itemList = array(); // ($key=>value)
  private $selectedItems = array(); // $key
  private $pleaseSelectEnabled = true;



  // construct with all parameters
  public function __construct($title, $name, $type, $value = "", $placeholder = "",
                              $description = "", $isReadOnly = false,
                              $isMultiSelectable = false, $itemList = array(),
                              $selectedItems = array(), $pleaseSelectEnabled = true) {

    $this->title = $title;
    $this->name = $name;
    $this->type = $type;
    $this->value = $value;
    $this->placeholder = $placeholder;
    $this->description = $description;
    $this->isReadOnly = $isReadOnly;
    $this->isMultiSelectable = $isMultiSelectable;
    $this->itemList = $itemList;
    $this->selectedItems = $selectedItems;
    $this->pleaseSelectEnabled = $pleaseSelectEnabled;
  }

  // return formItam as array
  /*private function asArray() {
    $result = array();
    $result["name"] = $this->name;
    $result["type"] = $this->type;
    $result["title"] = $this->title;
    $result["description"] = $this->description;
    $result["value"] = $this->value;
    $result["isMultiSelectable"] = $this->isMultiSelectable;
    $result["multipleSelectionCounter"] = $this->multipleSelectionCounter;
    $result["isReadOnly"] = $this->isReadOnly;
    return $result;
  }*/

  // return html of form field
  public function getHtml(){
    $result = '<div class="form-group">';
    $result .= $this->getFieldHtmlByType($this->type);
    $result .= '</div>';

    return $result;
  }

  //
  private function getFieldHtmlByType($type){
    $result = "";
    if($this->isInput($type)) {
      $result .= $this->getCommonLabelForField();
      $result .= '<input value="'.$this->value.'" id="'.$this->name.'" type="'.$type.'" placeholder="'.$this->placeholder.'" class="form-control" '.$this->getDisableOption().' aria-describedby="'.$this->name.'-help"/>';
      $result .= $this->getCommonDescriptionForField();
    }

    else if($this->isTextarea($type)) {
      $result .= $this->getCommonLabelForField();
      $result .= '<textarea id="'.$this->name.'" name="'.$this->name.'" class="form-control" rows="4" placeholder="'.$this->placeholder.'"  '.$this->getDisableOption().'>'.$this->value.'</textarea>';
      $result .= $this->getCommonDescriptionForField();
    }

    else if ($this->isCheckboxOrRadio($type)) {
      // TODO: here's a little stuff
      // if value is array, display multiple fields
      $result .= '<div class="'.$type.'">';
      $result .= '<label>';
      $result .= '<input type="'.$type.'" name="'.$this->name.'" />';
      $result .= '</label>';
      $result .= '</div>';
    }

    else if($this->isSelect($type)) {
      if(strlen($this->value) > 0) {
        $this->selectedItems[] = $this->value;
      }

      $multiSelectText = "";
      if($this->isMultiSelectable) {
        $multiSelectText = 'MULTIPLE size="6"';
      }

      $result .= $this->getCommonLabelForField();
      $result .= '<select name="'.$this->name.'" class="form-control" '.$multiSelectText.'>';
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

  private function getSelectOptions() {
    $result = "";
    if($this->pleaseSelectEnabled) {
      $result .= '<option value="null"> -- Please Select --</option>';
      //array_unshift($this->itemList, $item);
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
