<template>
    <div id="con">
<form action="" method="post" class="adlog">
  <div class="imgcontainer">
    <img src="https://www.w3schools.com/howto/img_avatar2.png" alt="Avatar" class="avatar">
  </div>

  <div class="cont">
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required id="uname">

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required id="pwd">

    <button class="adlog" type="submit">Login</button>
    <label>
      <input class="adlog" type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>
  <div class="cont" style="background-color:#f1f1f1">
    <button type="button" class="cancelbtn">Cancel</button>
    <span class="psw">Forgot <a href="#">password?</a></span>
  </div>
</form>
</div>
</template>