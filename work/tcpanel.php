<!DOCTYPE html>
<html>
 <head>
  <title>Task App - Task Panel</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 </head>
 <body>
  <div class="container">
   <br />
   
   <h3 align="center">Task Panel</h3>
   <br />
   <div align="right" style="margin-bottom:5px;">
    <button type="button" name="dash_btn" id="dash_btn" class="btn btn-success btn-xs"><a href="dashboard.php" style="text-decoration: none; color: white">Dashboard</a></button>
    <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Add</button>
   </div>

   <div class="table-responsive">
    <table class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>Name</th>
       <th>Description</th>
       <th>Priority</th>
       <th>Assignee</th>
       <th>Reporter</th>
       <th>Estimated Time</th>
       <th>Attandee(s)</th>
       <th>Edit</th>
       <th>Delete</th>
      </tr>
     </thead>
     <tbody></tbody>
    </table>
   </div>
  </div>
 </body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <form method="post" id="api_crud_form">
    <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title">Add Task</h4>
         </div>
         <div class="modal-body">
          <div class="form-group">
            <label>Enter Name</label>
            <input type="text" name="name" id="name" class="form-control" required/>
           </div>
           <div class="form-group">
            <label>Enter Description</label>
            <input type="text" name="description" id="description" class="form-control" required/>
           </div>
           <!-- <div class="form-group">
            <label>Enter Priority</label>
            <input type="text" name="priority" id="priority" class="form-control" required/>
           </div> -->
           <div class="form-group">
            <label for="priority">Select Priority</label>
            <select class="form-control" name="priority" id="priority">
              <option disabled selected>---</option>
              <option value="High">High</option>
              <option value="Normal">Normal</option>
              <option value="Low">Low</option>
            </select>
           </div>
           <div class="form-group">
            <label>Select Assignee</label>
            <?php
              $conn = new mysqli("localhost", "root", "", "task");
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT * FROM asignees";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();?>
              <select class="form-control" name="assignee" id="assignee">
                  <option disabled selected>---</option><?php
                  while($assignee = $result->fetch_assoc()){?>
                    <option value="<?php echo $assignee['name']?>"><?php echo $assignee['name']?></option><?php
                  }
                  ?>
              </select>
           </div>
           <div class="form-group">
            <label>Enter Reporter</label>
            <input type="text" name="reporter" id="reporter" class="form-control" required/>
           </div>
           <div class="form-group">
            <label>Enter Estimated Time</label>
            <input type="text" name="est_time" id="est_time" class="form-control" required/>
           </div>
           <div class="form-group">
            <label>Select Attendee(s)</label>
            <?php
              $conn = new mysqli("localhost", "root", "", "task");
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT * FROM attendees";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();?>
              <select class="form-control" name="attendees" id="attendees" multiple>
                  <option disabled selected>---</option><?php
                  while($attendee = $result->fetch_assoc()){?>
                    <option value="<?php echo $attendee['email']?>"><?php echo "Name: ".$attendee['name'].", Email: ".$attendee['email']?></option><?php
                  }
                  ?>
              </select>
           </div>
       </div>
       <div class="modal-footer">
        <input type="hidden" name="hidden_id" id="hidden_id" />
        <input type="hidden" name="action" id="action" value="insert" />
        <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Insert" />
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
   </form>
  </div>
   </div>
</div>


<script type="text/javascript">
$(document).ready(function(){

 fetch_data();

 function fetch_data()
 {
  $.ajax({
   url:"fetch.php",
   success:function(data)
   {
    $('tbody').html(data);
   }
  })
 }

 $('#add_button').click(function(){
  $('#action').val('insert');
  $('#button_action').val('Insert');
  $('.modal-title').text('Add Data');
  $('#apicrudModal').modal('show');
 });

 $('#api_crud_form').on('submit', function(event){
  event.preventDefault();
  var form_data = $(this).serialize();
  $.ajax({
  url:"action.php",
  method:"POST",
  data:form_data,
  success:function(data)
  {
    fetch_data();
    $('#api_crud_form')[0].reset();
    $('#apicrudModal').modal('hide');
    if(data == 'insert')
    {
    alert("Data Inserted Successfully");
    }
    if(data == 'update')
    {
    alert("Data Updated Successfully");
    }
  }
  });
 });

 $(document).on('click', '.edit', function(){
  var id = $(this).attr('id');
  var action = 'fetch_single';
  $.ajax({
   url:"action.php",
   method:"POST",
   data:{id:id, action:action},
   dataType:"json",
   success:function(data)
   {
    $('#hidden_id').val(id);
    $('#name').val(data.name);
    $('#description').val(data.description);
    $('#priority').val(data.priority);
    $('#assignee').val(data.assignee);
    $('#reporter').val(data.reporter);
    $('#est_time').val(data.est_time);
    $('#attendees').val(data.attendees);
    $('#action').val('update');
    $('#button_action').val('Update');
    $('.modal-title').text('Edit Data');
    $('#apicrudModal').modal('show');
   }
  })
 });

 $(document).on('click', '.delete', function(){
  var id = $(this).attr("id");
  var action = 'delete';
  if(confirm("Are you sure you want to remove this data Successfully?"))
  {
   $.ajax({
    url:"action.php",
    method:"POST",
    data:{id:id, action:action},
    success:function(data)
    {
     fetch_data();
     alert("Data Deleted Successfully");
    }
   });
  }
 });

});
</script>