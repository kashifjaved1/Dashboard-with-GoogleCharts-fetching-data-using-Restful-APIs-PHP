<?php

//test_api.php

include('Api.php');

$api_object = new API();

// fetch all task

if($_GET["action"] == 'fetch_all')
{
 $data = $api_object->fetch_all();
}

// inserting task

if($_GET["action"] == 'insert')
{
 $data = $api_object->insert();
}

// fetch_single task

if($_GET["action"] == 'fetch_single')
{
 $data = $api_object->fetch_single($_GET["id"]);
}

// action update

if($_GET["action"] == 'update')
{
 $data = $api_object->update();
}

// action delete

if($_GET["action"] == 'delete')
{
 $data = $api_object->delete($_GET["id"]);
}


// action assign-task

if($_GET["action"] == 'assign')
{
 $data = $api_object->assign();
}

echo json_encode($data);

