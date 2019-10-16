<h1>Choose your password</h1>

<div class="row">
    <div class="col-6">
        <form action="./index.php?content=choosepassword-script" method="post">
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter password" name="password" required>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Confirm password</label>
                <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirm password" name="checkpassword" required>
            </div>
            <input type=hidden value="<?php echo $_GET["id"]; ?>" name="id">
            <input type=hidden value="<?php echo $_GET["pw"]; ?>" name="pw">
            <button type="submit" class="btn btn-info btn-lg btn-block"">Submit</button>
        </form>
    </div>
    <div class="col-6">
        <img src="./img/lock.png" class="img-fluid rounded mx-auto d-block" alt="Responsive image" width="250px">
    </div>
</div>
<br>