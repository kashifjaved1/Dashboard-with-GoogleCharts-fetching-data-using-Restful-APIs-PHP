<?php

//fetch.php

$api_url = "http://localhost:8080/restapi_task_app/api/test_api.php?action=fetch_all";

$client = curl_init($api_url);

$chk = curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($client);

$result = json_decode($response);

$output = '';
//print("this is result: ".$response);
if(count($result) > 0)
{
 foreach($result as $row)
 {
  $output .= '
  <tr>
    <td>'.$row->name.'</td>
    <td>'.$row->description.'</td>
    <td>'.$row->priority.'</td>
    <td>'.$row->assignee.'</td>
    <td>'.$row->reporter.'</td>
    <td>'.$row->est_time.'</td>
    <td>'.$row->attendees.'(s)</td>
   <td><button type="button" name="edit" class="btn btn-warning btn-xs edit" id="'.$row->id.'">Edit</button></td>
   <td><button type="button" name="delete" class="btn btn-danger btn-xs delete" id="'.$row->id.'">Delete</button></td>
  </tr>
  ';
 }
}
else
{
 $output .= '
 <tr>
  <td colspan="4" align="center">No Data Found</td>
 </tr>
 ';
}

echo $output;

?>