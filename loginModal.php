<!-- Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login to iDiscuss</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/forum/partials/handleLogin.php" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="loginEmail">Enter Username</label>
                        <!-- <input type="email" class="form-control" id="loginEmail" name="loginEmail"
                            aria-describedby="emailHelp" placeholder="Enter email"> -->
                        <input type="text" class="form-control" id="loginEmail" name="loginEmail" aria-describedby="emailHelp" placeholder="Enter username">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small> -->
                    </div>
                    <div class="form-group">
                        <label for="lpasword">Password</label>
                        <input type="password" class="form-control" id="lpassword" name="lpassword" placeholder="Password">
                    </div>
                    <div class="form-check">

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>