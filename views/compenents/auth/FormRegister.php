
<div class="card">
    <div class="card-header text-center">
        <h2> "Welcome User" </h2>

    </div>
    <div class="card-body">
        <form action="../controller/auth/RegisterUserController.php" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["username"]) ? $_SESSION["usersError"]["username"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["password"]) ? $_SESSION["usersError"]["password"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" id="email" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["email"]) ? $_SESSION["usersError"]["email"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="number">Number</label>
                <input type="number" name="telephone" id="number" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["telephone"]) ? $_SESSION["usersError"]["telephone"] : '' ?></p>

            </div>

            <div class="form-group">
                <label for="date">Birth-Date</label>
                <input type="date" name="birth_date" id="date" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["birth_date"]) ? $_SESSION["usersError"]["birth_date"] : '' ?></p>

            </div>
            <a href="Auth.php?action=login"> Login</a>

            <div class="form-group">
                <input type="submit" value="Register" class="btn btn-success w-100 py-1 form-control" style="font-size: 20px; ">
            </div>
        </form>
    </div>



</div>
<?php

if (isset($_SESSION["usersError"])) {
    unset($_SESSION["usersError"]);
}
?>