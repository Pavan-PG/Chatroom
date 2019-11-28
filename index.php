<!DOCTYPE html>
  <html lang="en-US">
  <head>

    <meta charset="utf-8">

    <title>Forgot Password/Group Message</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,700">
     <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link href="style.css" rel="stylesheet">

    <!--[if lt IE 9]>
  <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
 <![endif]-->
  </head>

  <body>

    <div class="container">

      <div id="login">

        <form>

          <fieldset class="clearfix">
              <!-- <p  class="w3-white fontawesome" style="font-size: 20px; color: black; text-align: center;">Enter your mail ID to recover your password.</p><br> -->
             <p style="font-size: 20px; color: white; text-align: center;" id="testtext"><?php
             date_default_timezone_set("Asia/Kolkata");
echo "Today's date : ".date("d/m/Y");
?></p><br>
            <p><span class="fontawesome-user"></span><input type="text" style="color: black;" class="w3-white" onFocus="if(this.value == 'Enter your mail ID') this.value = ''" placeholder="Enter your mail ID" id="testemail" name="testemail" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><input type="submit" value="Submit" id="sub"></p>
             <p style="font-size: 15px; color: white; text-align: center;">-----OR-----</p><br>
          </fieldset>

        </form>
        <div class="w3-container w3-center">
         <a href="http://localhost:3300"><button value="Sign In" class="w3-button w3-pink w3-round-large">Sign In</button></a><br><br>
         <p id="sp"style="font-size: 15px; color: white; text-align: center;">Password will be sent to your mail id.</p><br>
       </div>
      </div> <!-- end login -->

    </div>
     <div id="particles-js"></div>
    <script type="text/javascript" src="particles.js"></script>
    <script type="text/javascript" src="app.js"></script>
    <script type="text/javascript">
    $("#sub").click(function(){
      var flag=1;
    $email = $("#testemail").val();
    var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            //var address = document.getElementById[email].value;
            if (reg.test($email) == false) 
            {
                alert("Please enter a proper mail ID \nExample : someone@email.com");
            }
            else
            {
                $("#sp").html("Sending Password......");
                $.ajax({
                type: 'POST',
                url: 'test.php',
                data : {testemail:$email},
                success: function(data) {
                    alert("Sorry your mail ID is not in our database!");
                }
            });
            }

   });
 </script>
  </body>
</html>