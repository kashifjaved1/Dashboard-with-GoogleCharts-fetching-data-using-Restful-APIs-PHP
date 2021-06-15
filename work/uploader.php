<!DOCTYPE html>
<html>
    <head>
        <title>File Upload</title>
        <meta content="text/html; charset=UTF-8" http-equiv="Content-Type"/>
        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
        <script type="text/javascript" src="js/javascript.js"></script>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/style.css" />
        <style>
          select {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
          }
        </style>
    </head>
    <body>
      <h1 style="text-align: center">File Upload</h1>
        <div class="main-container">
            <div class="section">
                <form id="ajax-upload-form" enctype="multipart/form-data">
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
                      <select class="form-control" name="assignee" id="assignee" required>
                          <option disabled selected>---</option><?php
                          while($assignee = $result->fetch_assoc()){?>
                            <option value="<?php echo $assignee['name']?>"><?php echo $assignee['name']?></option><?php
                          }
                          ?>
                      </select>
                  </div>
                  <br>
                  <div class="row">
                      <div class="col-10">
                          <input type="file" class="file-input" name="ajax_file" multiple="multiple"/>
                      </div>
                      <div class="col-2 text-right">
                          <button type="submit" class="btn btn-blue"><i class="fa fa-upload"></i> Upload</button>
                      </div>
                  </div>
                </form>
                <div class="progress-container"></div>
                <br>
                <h2>Download Files</h2>
<?php
$fileList = glob('uploaded/*');
$path    = 'uploaded/';
$files = array_diff(scandir($path), array('.', '..'));
//Loop through the array that glob returned.
foreach($files as $filename){?>
  <a href="uploaded/<?php echo $filename; ?>"><?php echo $filename; ?></a><br><?php
}
?>
            </div>
        </div>
      
    </body>
</html>
</script>