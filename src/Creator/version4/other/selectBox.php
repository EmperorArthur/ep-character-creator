<?php

/**
 * An item in a selectbox
 */
class selectable{
    public $id;
    public $name;

    function __construct($name,$id){
        $this->name = $name;
        $this->id = $id;
    }
}

/**
 * A generic <select> box used for dropdowns.
 */
class selectBox{
    public $selectables;    //Items to be selected from the dropdown
    public $id;             //HTML Id of the <select>
    public $class;          //class of the <select>

    function __construct($class,$id){
        $this->class = $class;
        $this->id = $id;
        $this->selectables = array();
    }

    /**
     * Add an additional option
     */
    function addSelectable($name,$id){
        $item = new selectable($name,$id);
        array_push($this->selectables,$item);
    }

    /**
     * Print the html for the selectbox
     */
     function printHtml(){
        echo "<select class='".$this->class."' id='".$this->id."'>";
        foreach($this->selectables as $i){
            echo "<option value='".$i->id."'>".$i->name."</option>";
        }
        echo "</select>";
     }
}
?>
