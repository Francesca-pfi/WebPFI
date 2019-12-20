<!-- affichage de la page de my profile, arrivé de myProfile.php-->

<div class="containerCustom">
  <h1 class="blanchedalmond">My Profile</h1>
  <div class="card" id="myProfile">
    <div class="card-header" id="pfpImage">   
      <img class="m-1" alt="Profile picture" src="<?php echo $_SESSION["userPFP"]; ?>">    
    </div>
    <div class="card-body" id="changeInfo">     
      <div id="userInfo">  
        <div>
          <h3>Update Infos</h3>            
          <form method = "post" action = "./DOMAINLOGIC/updateinfo.dom.php">
              <div class="form-group">
                  <label for="email">Email:</label>
                  <input type="email" class="form-control" name="email" id="email" value = <?php echo $_SESSION['userEmail']; ?>><br>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" name="username" id="username" value = <?php echo $_SESSION['userName']; ?>><br>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              <button class="btn btn-outline-light mb-sm-3" type="submit">Update profile</button>
          </form>       
        
          <h3>Update profile picture</h3>
          <form method = "post" action = "./DOMAINLOGIC/updatepfp.dom.php" enctype="multipart/form-data">               
              <div class="form-group">
                  <input type="file" class="form-control" name="Media" id="Media" required>
                  <div class="valid-feedback">Valid.</div>
                  <div class="invalid-feedback">Please fill out this field.</div>
              </div>
              <button class="btn btn-outline-light mb-sm-3" type="submit">Update picture</button>
          </form>
        </div>
      </div>   
      <div id="passInfo">     
        <div>
          <h3>Change Password</h3>
          <form method = "post" action = "./DOMAINLOGIC/updatepw.dom.php">
            <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" name="oldpw" id="oldpw" required><br>
                    <div class="valid-feedback">Valid.</div>
                    <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">New password:</label>
                <input type="password" class="form-control" name="newpw" id="newpw" required><br>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <div class="form-group">
                <label for="pwd">Repeat new password:</label>
                <input type="password" class="form-control" name="pwValidation" id="pwValidation" required><br>
                <div class="valid-feedback">Valid.</div>
                <div class="invalid-feedback">Please fill out this field.</div>
            </div>
            <button class="btn btn-outline-light mb-sm-3" type="submit">Change Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
