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
  <h2>Edit Composer</h2>
    <?php if(isset($errors) && count($errors) ) { ?>
          <div class="alert alert-danger">
              <?php foreach ($errors as $key => $value) {
                   echo $value; echo '<br>';
                  }
              ?>
          </div>
        <?php } ?>
<form role="form" method="post" action="../composercontroller/updateComposer">
        <div class="form-group"> 
         <label for="Title">Composer First Name</label>
          <input type="text" class="form-control" id="title" name="composerFirstName" placeholder="Enter FN" value="<?php echo $composerFirstName ?>">
          <input type="hidden" class="form-control" id="title" name="composerFirstNameOriginal" placeholder="Enter FN" value="<?php echo $composerFirstName ?>">
        
          <label for="price">Composer Last Name</label>
          <input type="text" class="form-control" id="price" name="composerLastName" placeholder="Enter LN" value="<?php echo $composerLastName ?>">
          <input type="hidden" class="form-control" id="price" name="composerLastNameOriginal" placeholder="Enter Price" value="<?php echo $composerLastName ?>">
       
          <label for="Title">Composer Birthday</label>
          <input type="text" class="form-control" id="title" name="composerBirthday" placeholder="Enter Bday" value="<?php echo $composerBirthday ?>">
          <input type="hidden" class="form-control" id="title" name="composerBirthdayOriginal" placeholder="Enter Title" value="<?php echo $composerBirthday ?>">
       
          <label for="price">Composer Description</label>
          <input type="text" class="form-control" id="price" name="composerDescrip" placeholder="Enter Descrip" value=<?php echo $composerDescrip ?>>
          <input type="hidden" class="form-control" id="price" name="composerDescripOriginal" placeholder="Enter Price" value=<?php echo $composerDescrip ?>>

        </div>
        
        <button type="submit" name="updateSubmit" id="updateSubmit" class="btn btn-primary" value="Submit">Edit this composer!</button></div>
        </form>
</body>
</html>
