<?php



function check_empty_fields($required_field_array){
    $form_errors=array();

    foreach($required_field_array as $name_of_field){
        if(!isset($_POST[$name_of_field])|| $_POST[$name_of_field]==NULL){
            $form_errors[]=$name_of_field. "  is required field";
        }
    }
    return $form_errors;
}

function check_min_length($field_to_check_length){


    $form_errors=array();



    foreach($field_to_check_length as $name_of_field =>$minimum_length_required){
        if(strlen(trim($_POST[$name_of_field])) < $minimum_length_required){
 $form_errors[]=$name_of_field . " is too short, must be {$minimum_length_required}  characters long";
        }
    }
    return $form_errors;
}

function check_email($data){
    $form_errors=array();

    $key ='email';

    if(array_key_exists($key,$data)){
        if($data[$key] !=null){
            $key =filter_var($key,FILTER_SANITIZE_EMAIL);

            if(filter_var($data[$key],FILTER_VALIDATE_EMAIL)==false){
                $form_errors[]=$key."is not valid email address";
                
            }
        }
    }
    return $form_errors;
}
function show_errors($form_error_array){
    $errors = "<p><ul style='color:red'>";
    foreach($form_error_array as $the_error){
        $errors .= "<li>{$the_error}</li>";
    }
    $errors .= "</ul></p>";
    return $errors;
 }
?>