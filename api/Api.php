<?php

//Api.php

class API
{
 private $connect = '';

 function __construct()
 {
  $this->database_connection();
 }

 function database_connection()
 {
  $this->connect = new PDO("mysql:host=localhost;dbname=task", "root", "");
 }

 // fetch_all function

 function fetch_all()
 {
  $query = "SELECT * FROM assign ORDER BY id";
  $statement = $this->connect->prepare($query);
  if($statement->execute())
  {
   while($row = $statement->fetch(PDO::FETCH_ASSOC))
   {
    $data[] = $row;
   }
   return $data;
  }
 }

 // delete function

 function delete($id)
 {
  $query = "DELETE FROM assign WHERE id = '".$id."'";
  $statement = $this->connect->prepare($query);
  if($statement->execute())
  {
   $data[] = array(
    'success' => '1'
   );
  }
  else
  {
   $data[] = array(
    'success' => '0'
   );
  }
  return $data;
 }

 // insert function

 function insert()
 {
  if(isset($_POST["name"]))
  {
   $form_data = array(
    ':name' => $_POST['name'],
   ':description' => $_POST['description'],
   ':priority' => $_POST['priority'],
   ':assignee' => $_POST['assignee'],
   ':reporter' => $_POST['reporter'],
   ':est_time' => $_POST['est_time'],
   ':attendees' => $_POST['attendees']
   );
   $query = "
   INSERT INTO assign 
   (name, description, priority, assignee, reporter, est_time, attendees) VALUES 
   (:name, :description, :priority, :assignee, :reporter, :est_time, :attendees)
   ";
   $statement = $this->connect->prepare($query);
   if($statement->execute($form_data))
   {
    $data[] = array(
     'success' => '1'
    );
   }
   else
   {
    $data[] = array(
     'success' => '0'
    );
   }
  }
  else
  {
   $data[] = array(
    'success' => '0'
   );
  }
  return $data;
 }

 // fetch_single function

 function fetch_single($id)
 {
  $query = "SELECT * FROM assign WHERE id='".$id."'";
  $statement = $this->connect->prepare($query);
  if($statement->execute())
  {
   foreach($statement->fetchAll() as $row)
   {
    $data['name'] = $row['name'];
    $data['description'] = $row['description'];
    $data['priority'] = $row['priority'];
    $data['assignee'] = $row['assignee'];
    $data['reporter'] = $row['reporter'];
    $data['est_time'] = $row['est_time'];
    $data['attendees'] = $row['attendees'];
   }
   return $data;
  }
 }

 // update function

 function update()
 {
  if(isset($_POST["name"]))
  {
   $form_data = array(
    ':name' => $_POST['name'],
   ':description' => $_POST['description'],
   ':priority' => $_POST['priority'],
   ':assignee' => $_POST['assignee'],
   ':reporter' => $_POST['reporter'],
   ':est_time' => $_POST['est_time'],
   ':attendees' => $_POST['attendees'],
    ':id'   => $_POST['id']
   );
   $query = "
   UPDATE assign 
   SET name = :name, description = :description, priority = :priority, assignee = :assignee, reporter = :reporter, est_time = :est_time, attendees = :attendees
   WHERE id = :id
   ";
   $statement = $this->connect->prepare($query);
   if($statement->execute($form_data))
   {
    $data[] = array(
     'success' => '1'
    );
   }
   else
   {
    $data[] = array(
     'success' => '0'
    );
   }
  }
  else
  {
   $data[] = array(
    'success' => '0'
   );
  }
  return $data;
 }

  // assign function

  function assign()
  {
   if(isset($_POST["assignee"]))
   {
    $form_data = array(
    ':assignee' => $_POST['assignee'],
    ':task' => $_POST['task']
    );
    $query = "
    INSERT INTO taskassigned 
    (assignee, task) VALUES 
    (:assignee, :task)
    ";
    $statement = $this->connect->prepare($query);
    if($statement->execute($form_data))
    {
     $data[] = array(
      'success' => '1'
     );

     $query = "
     UPDATE assign 
     SET assignee = :assignee
     WHERE name = :task
     ";
     $statement = $this->connect->prepare($query);
     $statement->execute($form_data);

    }
    else
    {
     $data[] = array(
      'success' => '0'
     );
    }
   }
   else
   {
    $data[] = array(
     'success' => '0'
    );
   }
   return $data;
  }

}