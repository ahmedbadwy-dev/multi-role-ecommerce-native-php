<div class="card">
    <div class="card-header text-center">
        <h2> "Welcome User" </h2>

    </div>
    <div class="card-body">
        <form action="../controller/auth/LoginUserController.php" method="post">

            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["email"]) ? $_SESSION["usersError"]["email"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["password"]) ? $_SESSION["usersError"]["password"] : '' ?></p>

            </div>


            <p class="text-danger text-center"><?= isset($_SESSION["loginUserStatus"]) ? $_SESSION["loginUserStatus"] : '' ?></p>
                   <a href="Auth.php?action=register"> Register</a>
            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-success w-100 py-1 form-control" style="font-size: 20px; ">
            </div>
        </form>
    </div>



</div>
<?php

if (isset($_SESSION["usersError"])) {
    unset($_SESSION["usersError"]);
}
if (isset($_SESSION["loginUserStatus"])) {
    unset($_SESSION["loginUserStatus"]);
}
?>