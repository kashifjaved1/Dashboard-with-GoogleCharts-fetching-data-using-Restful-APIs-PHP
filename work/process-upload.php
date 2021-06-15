<?php
if($_FILES && !$_FILES['ajax_file']['error']){
    move_uploaded_file($_FILES['ajax_file']['tmp_name'],"uploaded/".$_FILES['ajax_file']['name']);
}
?>