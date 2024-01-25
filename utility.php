<?php



function check_empty($required_field_array){
    $form_error=array();

    foreach($required_field_array as $name_of_field){
        if(!isset($_POST[$name_of_field])|| $_POST[$name_of_field]==NULL){
            $form_error[]=$name_of_field."is required field";
        }
    }
    return $form_error;
}

function check_min_length($field_to_check_length){


    $form_error=array();



    foreach($field_to_check_length as $name_of_field =>$minimum_length_required){
        if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required){
 $form_error[]=$name_of_field." is too short, must be {$minimum_length_required}  characters long";
        }
    }
    return $form_error;
}

function check_email($data){
    $form_error=array();

    $key ='email';

    if(array_key_exists($key,$data)){
        if($_POST[$key] !=null){
            $key =filter_var($key,FILTER_SANITIZE_EMAIL);

            if(filter_var($_POST[$key],FILTER_VALIDATE_EMAIL)==false){
                $form_error[]=$key."is not valid email address";
                
            }
        }
    }
    return $form_error;
}
 function show_errors($form_error_array){
    $errors="<p><ul style='color:red'>";
    foreach($form_error_array as $the_error){
        $errors .="<li>{$the_error}</li>";
    }
    $errors .="</ul></p>";
    
 }
?>