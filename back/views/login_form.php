<form action="?action=login">
  <h1>
    <?= $login_message ?>
  </h1>
  <div class="container">
    <label><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required="required" pattern="[A-Za-z0-9]{1,20}">

    <label><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required="required" pattern="[A-Za-z0-9]{1,20}">

    <button type="submit">Login</button>
   
  </div>
</form> 
