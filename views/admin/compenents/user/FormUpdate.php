<?php
require_once __DIR__ . "/../../../../model/User.php";

$userClass = new User();

$action = $_GET["action"] ?? null;
$userId = $_GET["userId"] ?? null;
if ($userId != null) {
    $user = $userClass->get_user($userId);
}

$roles = $userClass->get_all_roles();

?>


<div class="card">
    <div class="card-header text-center">
        <h3> Update User<?= isset($userId) ? htmlspecialchars($user['username']) : '' ?></h3>
    </div>
    <div class="card-body">
        <form action="../../controller/admin/user/UpdateUserController.php" method="post">
            <input type="hidden" value="<?= $action == 'edit' && isset($userId) ? htmlspecialchars($user['id']) : '' ?>" name="id">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="username" value="<?= $action == 'edit' && isset($userId) ? htmlspecialchars($user['username']) : '' ?>" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["username"]) ? $_SESSION["usersError"]["username"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["password"]) ? $_SESSION["usersError"]["password"] : '' ?></p>
            </div>
            <div class="form-group">
                <label for="email">E-mail</label>
                <input type="email" name="email" value="<?= $action == 'edit' && isset($userId) ? htmlspecialchars($user['email']) : '' ?>" id="email" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["email"]) ? $_SESSION["usersError"]["email"] : '' ?></p>

            </div>

            <div class="form-group">
                <label for="number">Number</label>
                <input type="number" name="telephone" value="<?= $action == 'edit' && isset($userId) ? htmlspecialchars($user['telephone']) : '' ?>" id="number" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["telephone"]) ? $_SESSION["usersError"]["telephone"] : '' ?></p>

            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select name="role" id="role" class="form-control">
                    <?php
                    foreach ($roles as $role) {
                    ?>
                        <option value="<?= htmlspecialchars($role['id']) ?>" <?= isset($userId) && $action == 'edit' && $role["id"] == $user["role_id"] ? 'selected' : '' ?>><?= htmlspecialchars($role["role"]) ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($_SESSION["usersError"]["role"]) ? $_SESSION["usersError"]["role"] : ''  ?></p>

            </div>
            <div class="form-group">
                <label for="date">Birth-Date</label>
                <input type="date" name="birth_date" value="<?= isset($userId) ? htmlspecialchars($user['birth_date']) : ''  ?>" id="date" class="form-control">
                <p class="text-danger"><?= isset($_SESSION["usersError"]["birth_date"]) ? $_SESSION["usersError"]["birth_date"] : '' ?></p>

            </div>
            <div class="form-group">
                <input style="font-size:20px; font-weight:500; "  type="submit" value="Update :  <?= htmlspecialchars($user['username']) ?>  " class="btn btn-success w-100 py-1 form-control" style="font-size: 20px; ">
            </div>
        </form>
    </div>
    <?php
    if (isset($_SESSION["usersError"])) {
        unset($_SESSION["usersError"]);
    }
    ?>
</div>