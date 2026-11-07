<?php
require_once  __DIR__ . "/../../../../model/User.php";

$instanse = new User();
$users = $instanse->get_all_users();


?>
<div class="table-responsive">
    <table class="table table-striped table-borderless table-hover">
        <thead>
            <tr>
                <td scope="col">Username</td>
                <td scope="col">E-mail</td>
                <td scope="col">telephone</td>
                <td scope="col">Age</td>
                <td scope="col">role</td>
                <td scope="col">modify</td>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($users as $user) {
            ?>
                <tr>
                    <td><?= $user["username"] ?></td>
                    <td><?= $user["email"] ?></td>
                    <td><?= $user["telephone"] ?></td>
                    <td><?= $user["birth_date"] ?></td>
                    <td><?= $user["role"] ?></td>
                    <td>
                        <div class="d-flex flex-column flex-md-row">
                            <a href="../../controller/admin/user/DeleteUserController.php?userId=<?= htmlspecialchars($user['id']) ?> " class="btn btn-danger my-1 mx-1 py-2">Delete</a>

                            <a href="UserPage.php?action=edit&userId=<?= htmlspecialchars($user['id']) ?> " class="btn btn-info ">Update</a>
                        </div>
                    </td>


                </tr>
            <?php } ?>
        </tbody>





    </table>
</div>
<style >
td{
   width:fit-content;
  
}



</style>