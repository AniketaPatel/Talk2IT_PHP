<!DOCTYPE html>

<html>
<head>
  <title>Our Modal Dialog Example</title>
  <style>
  /* This is the CSS for the normal div */

  .normal {
    background-color: lightblue;
    width: 900px;
    min-height: 200px;
    padding: 20px;
  }

.background {
  background-color: black;
  opacity: 90%;
  filter:alpha(opacity=90);
  background-color: rgba(0,0,0,0.90);
  width: 100%;
  min-height: 100%;
  overflow: hidden;
  position: absolute;
  top: 0;
  left: 0;
  color: white;
}


  /* This is the CSS for the modal dialog window */
  .modal {

    background-color: white;
    color: black;
    border: 1px solid gray;
    padding: 20px;
    display: block;
    position: absolute;
    top: 10px;
    right: 10px;
    width: 400px;
    height: 300px;
  }

  /* This gives us the styling for the background */

  .background {

    background-color: black;
    opacity: 90%;
    filter:alpha(opacity=90);
    background-color: rgba(0,0,0,0.90);
    width: 100%;
    min-height: 100%;
    overflow: hidden;
    position: absolute;
    top: 0;
    left: 0;
    color: white;
  }
  </style>

</head>

<body>

  <div class="normal">
    This is a regular div inline with the page (default
    position in CSS is static).
  </div>

  <div class="background"></div>

   <?php 
   if(isset
   ?>
</body>
</html>
