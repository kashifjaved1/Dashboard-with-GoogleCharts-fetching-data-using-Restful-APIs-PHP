<!DOCTYPE html>
<html>
 <head>
  <title>Dashboard</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ["Element", "Density", { role: "style" } ],
                <?php
                    // $conn = new mysqli("localhost", "root", "", "task");
                    // $sql = "select distinct assignee from taskassigned";
                    // $stmt = $conn->prepare($sql);
                    // $stmt->execute();
                    // $result = $stmt->get_result();
                    // while($assignee = $result->fetch_assoc()){
                    //     echo "['".$assignee['assignee']."',1, 'color: #e5e4e2'],";
                    // }
                    $count = 0;
                    $conn = new mysqli("localhost", "root", "", "task");
                    $sql = "select distinct assignee from taskassigned";
                    if ($result = $conn -> query($sql)) {
                        while ($row = $result -> fetch_row()) {
                            $var = $row[0];
                            $sql1 = "select task from taskassigned where assignee = '$var'";
                            $result1 = $conn->query($sql1);
                            while ($r = $result1->fetch_row()) {
                                $count++;
                            }
                            $s1 = "['";
                            $s2 = $row[0];
                            $s3 = "', ";
                            $s4 = $count;
                            $s5 = ", 'color: #e5e4e2'],"; 
                            $finalString = $s1.$s2.$s3.$s4.$s5;
                            echo $finalString;
                            $count = 0;
                        }
                    }
                ?>
            ]);

            var view = new google.visualization.DataView(data);
            view.setColumns([0, 1,
                            { calc: "stringify",
                                sourceColumn: 1,
                                type: "string",
                                role: "annotation" },
                            2]);

            var options = {
                title: "Assignees with number of Tasks",
                width: 600,
                height: 400,
                bar: {groupWidth: "95%"},
                legend: { position: "none" },
            };
            var chart = new google.visualization.BarChart(document.getElementById("barchart_values"));
            chart.draw(view, options);
            }
        </script>

 </head>
 <body>
  <div class="container">
   <br />
   
   <h3 align="center">Dashboard</h3>
   <br />
   <div align="right" style="margin-bottom:5px;">
   <button type="button" class="btn btn-warning btn-xs"><a href="tcpanel.php" style="text-decoration: none; color: white">Task Panel</a></button>
    <button type="button" class="btn btn-success btn-xs"><a href="uploader.php" style="text-decoration: none; color: white">Upload</a></button>
    <button type="button" name="add_button" id="add_button" class="btn btn-success btn-xs">Assign Task</button>
   </div>
  </div>
  <center><div id="barchart_values" style="width: 900px; height: 300px;"></div></center>
 </body>
</html>

<div id="apicrudModal" class="modal fade" role="dialog">
 <div class="modal-dialog">
  <div class="modal-content">
   <form method="post" id="api_crud_form">
    <div class="modal-header">
           <button type="button" class="close" data-dismiss="modal">&times;</button>
           <h4 class="modal-title"></h4>
         </div>
         <div class="modal-body">
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
           </div><div class="form-group">
            <label>Select Task to Assign</label>
            <?php
              $conn = new mysqli("localhost", "root", "", "task");
              if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
              }
              $sql = "SELECT * FROM assign";
              $stmt = $conn->prepare($sql);
              $stmt->execute();
              $result = $stmt->get_result();?>
              <select class="form-control" name="task" id="task">
                  <option disabled selected>---</option><?php
                  while($task = $result->fetch_assoc()){?>
                    <option value="<?php echo $task['name']?>"><?php echo $task['name']?></option><?php
                  }
                  ?>
              </select>
           </div>
       </div>
       <div class="modal-footer">
        <input type="hidden" name="action" id="action" value="assign" />
       <input type="submit" name="button_action" id="button_action" class="btn btn-info" value="Assign"  style="float: left" />
         </div>
   </form>
  </div>
   </div>
</div>


<script type="text/javascript">
$(document).ready(function(){

 $('#add_button').click(function(){
  $('#action').val('assign');
  $('#button_action').val('Assign');
  $('.modal-title').text('Assign Task');
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
    $('#api_crud_form')[0].reset();
    $('#apicrudModal').modal('hide');
    if(data == 'assign')
    {
      alert("Task Assigned Successfully");
    }
  }
  });
 });
});
</script>