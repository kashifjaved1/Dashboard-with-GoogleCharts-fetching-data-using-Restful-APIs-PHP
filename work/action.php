<?php

//action.php

// action - insert

if(isset($_POST["action"]))
{
 if($_POST["action"] == 'insert')
 {
  $form_data = array(
   'name' => $_POST['name'],
   'description' => $_POST['description'],
   'priority' => $_POST['priority'],
   'assignee' => $_POST['assignee'],
   'reporter' => $_POST['reporter'],
   'est_time' => $_POST['est_time'],
   'attendees' => $_POST['attendees']
  );
  $api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=insert";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_POST, true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
  $result = json_decode($response, true);
  foreach($result as $keys => $values)
  {
   if($result[$keys]['success'] == '1')
   {
    echo 'insert';
   }
   else
   {
    echo 'error';
   }
  }
 }
}

// action - fetch_single

if(isset($_POST["action"]))
{

 if($_POST["action"] == 'fetch_single')
 {
  $id = $_POST["id"];
  $api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=fetch_single&id=".$id."";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  echo $response;
 }

 if($_POST["action"] == 'update')
 {
  $form_data = array(
    'id' => $_POST['hidden_id'],
    'name' => $_POST['name'],
    'description' => $_POST['description'],
    'priority' => $_POST['priority'],
    'assignee' => $_POST['assignee'],
    'reporter' => $_POST['reporter'],
    'est_time' => $_POST['est_time'],
    'attendees' => $_POST['attendees']
    
  );
  $api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=update";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_POST, true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
  $result = json_decode($response, true);
  foreach($result as $keys => $values)
  {
   if($result[$keys]['success'] == '1')
   {
    echo 'update';
   }
   else
   {
    echo 'error';
   }
  }
 }
}

// action - delete

if(isset($_POST["action"]))
{
 
 if($_POST["action"] == 'delete')
 {
  $id = $_POST['id'];
  $api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=delete&id=".$id."";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  echo $response;
 }
}


if(isset($_POST["action"]))
{
 if($_POST["action"] == 'assign')
 {
  $form_data = array(
   'assignee' => $_POST['assignee'],
   'task' => $_POST['task']
  );
  $api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=assign";
  $client = curl_init($api_url);
  curl_setopt($client, CURLOPT_POST, true);
  curl_setopt($client, CURLOPT_POSTFIELDS, $form_data);
  curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($client);
  curl_close($client);
  $result = json_decode($response, true);
  foreach($result as $keys => $values)
  {
   if($result[$keys]['success'] == '1')
   {
    echo 'assign';
   }
   else
   {
    echo 'error';
   }
  }
 }
}

?>