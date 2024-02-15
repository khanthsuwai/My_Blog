<?php

session_start();

if(isset($_SESSION['user_id'])){
    
    require "../dbconnect.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $category_id= $_POST['categoryID'];
        echo $category_id;

        $sql = "DELETE FROM categories WHERE id = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->execute();

        header('location: categories.php');

    }else{
        include "layouts/side_nav.php";
    
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $categories = $stmt->fetchAll();
        // var_dump($categories);
    }
?>

                <main>
                    <div class="container-fluid px-4">
                        <div class="mt-3">
                            <h1 class="mt-4 d-inline">Categories</h1>
                            <a href="create_category.php" class="btn btn-lg btn-primary float-end">Create Category</a>
                        </div>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Categories</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Categories
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created at </th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Created at </th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        foreach($categories as $category){

                                            $timestamp = strtotime($category['created_at']);
                                        ?>
                                        <tr>
                                            <td><?= $category['name'] ?></td>
                                            <td><?= date('d M,Y',$timestamp) ?></td>
                                            <td>
                                                <a href="edit_category.php?categoryID=<?= $category['id'] ?>" class="btn btn-sm btn-outline-warning">Edit</a>
                                                <button class="btn btn-sm btn-outline-danger categorydelete" data-category_id="<?= $category['id'] ?>">Delete</button>
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
    <div class="modal fade" id="categoryDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="categoryID" id="categoryID">
                    <button type="submit" class="btn btn-danger">Yes</button>
                </form>
            </div>
            </div>
        </div>
    </div>

<?php

    include "layouts/footer.php";

}else{
    header('location: ../index.php');
}
?>

