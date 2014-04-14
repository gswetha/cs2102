<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>CS2102 - Music Catalogue</title>

  <style type="text/css">
  </style>
</head>

<body>
<div style="padding-left:150px; padding-right:150px;">
  <h2>Add Composer</h2>
    <?php if(isset($errors) && count($errors) ) { ?>
          <div class="alert alert-danger">
              <?php foreach ($errors as $key => $value) {
                   echo $value; echo '<br>';
                  }
              ?>
          </div>
        <?php } ?>
<form role="form" method="post" action="../composercontroller/addComposer">
        <div class="form-group">
        
          <label for="year">Composer First Name</label>
          <input type="text" class="form-control" id="length" name="composerFirstName" placeholder="Enter first name">
        
          <label for="year">Composer Last Name</label>
          <input type="text" class="form-control" id="length" name="composerLastName" placeholder="Enter last name">
       
          <label for="year">Composer Birthday</label>
          <input type="text" class="form-control" id="length" name="composerBirthday" placeholder="Enter birthday">

          <label for="year">Composer Description</label>
          <input type="text" class="form-control" id="length" name="composerDescrip" placeholder="Enter description">
        </div>
        
        <button type="submit" name="submit_add_composer" id="submit_add_composer" class="btn btn-primary" value="Submit">Add this Composer!</button></div>
        </form>
</body>
</html>
