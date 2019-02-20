<h1>Registration</h1>

<form  id="regForm" action="registration/run" method="post">

    <label class="iField"> Login              :</label><input type="text" name="login"  required autofocus><br>
    <div class="error" id="loginErr"></div>
    <label class="iField"> Password           :</label><input type="password" name="password"  required><br>
  
    <label class="iField">Enter password again:</label><input type="password" name="password_again" required><br>
    <div class="error" id="passErr"></div>
    <label class="iField">Email               :</label><input type="email" name="email" required><br>
     <div class="error" id="emailErr"></div>
    <input type="submit" value="REGISTR">


</form>
<div id="errorShow"></div>