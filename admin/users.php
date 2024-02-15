<?php

session_start();

if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == "Admin"){

    require "../dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $user_id = $_POST['userID'];
        // echo $user_id;

        $sql = "DELETE FROM users WHERE id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id',$user_id);
        $stmt->execute();

        header('location: users.php');

    }else{
        
        include "layouts/side_nav.php";

        $sql = "SELECT * FROM users";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $users = $stmt->fetchAll();
        // var_dump($users);
    }
?>

<main>
    <div class="container-fluid px-4">
        <div class="mt-3">
                <h1 class="mt-4 d-inline">Users</h1>
                <a href="create_user.php" class="btn btn-lg btn-primary float-end">Create User</a>
        </div>
        
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active">Users</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Users
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Role</th>
                            <th>Created at </th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email </th>
                            <th>Role</th>
                            <th>Created at </th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        foreach($users as $user){

                            $timestamp = strtotime($user['created_at']);
                        ?>
                        <tr>
                            <td><?= $user['name'] ?></td>
                            <td><?= $user['email'] ?></td>
                            <td><?= $user['role'] ?></td>
                            <td><?= date('d M,Y',$timestamp) ?></td>
                            <td>
                                <a href="edit_user.php?userID=<?= $user['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                <button class="btn btn-sm btn-outline-danger userdelete" data-user_id="<?= $user['id'] ?>">Delete</button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</main>

<!-- Delete Modal -->
<div class="modal fade" id="userDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure want to delete?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
            <form action="" method="post">
                <input type="hidden" name="userID" id="userID">
                <button type="submit" class="btn btn-danger">Yes</button>
            </form>
        </div>
        </div>
    </div>
</div>

<?php
    include "layouts/footer.php";

}else{
    header('location: index.php');
}

?>
