  <!-- Modals starts here -->



   <!-- Logout Modal starts here -->
    <div class="modal fade" id="logoutModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <!-- modal header starts here -->
          <div class="modal-header">
            <h5 class="modal-title">Are you sure you want to logout?</h5>
          </div>
          <!-- modal header ends here -->

          <form action="../logout.php" method="post">
            <!-- modal body starts here -->
            <div class="modal-body">
              <div class="">
                <div class="row">
                  <div class="col-3 offset-3">
                    <button type="submit" name="logout" class="btn btn-dark btn-block">Yes</button>
                  </div>
                  <div class="col-3">
                    <button class="btn btn-danger btn-block" data-dismiss="modal">No</button>
                  </div>
                </div>
                
                
              </div>
            </div>
            <!-- modal body ends here -->
          </form>
        </div>
      </div>
    </div>
  <!-- Logout Modal ends here -->




  <!-- Change Password modal starts here -->
    <div class="modal fade" id="changePasswordModal" data-backdrop="static" data-keyboard="false">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-dark text-white">
            <h5 class="modal-title">Change Password</h5>
            <button class="btn close" data-dismiss="modal">&times;</button>
          </div>
          <form action="admin_profile.php" method="POST">
            <div class="modal-body">
                <div class="form-group">
                  <label for="password">Old Password</label>
                  <input type="password" name="old_password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password2">New Password</label>
                  <input type="password" name="new_password" id="password2" class="form-control" required>
                </div>
                <div class="form-group">
                  <label for="password3">Confirm New Password</label>
                  <input type="password" name="new_password_confirm" id="password3" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="change_password" class="btn btn-dark"><span class="fa fa-lock"></span> Change Password</button>
                <button class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  <!-- Change Password modal ends here -->



  <!-- Modals end here -->