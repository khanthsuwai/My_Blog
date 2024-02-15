<?php

session_start();

if(isset($_SESSION['user_id'])){
    
    require "../dbconnect.php";

    $category_id = $_GET['categoryID'];
    // echo $category_id;
    // die();

    $sql = "SELECT * FROM categories WHERE id = :id ";
    $stmt = $conn->prepare($sql);
    $stmt-> bindParam(':id',$category_id);
    $stmt->execute();
    $category = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($category);
    // die();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $name = $_POST['name'];
        // echo $name;
        
        $sql = "UPDATE categories SET name=:name WHERE id = :category_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':category_id',$category_id);
        $stmt->bindParam(':name',$name);
        $stmt->execute();

        header("location: categories.php");
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
                <h1 class="mt-4 d-inline"> Edit Categories</h1>
                <a href="categories.php" class="btn btn-lg btn-danger float-end">Cancel</a>
            </div>
            
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="categories.php">Categories</a></li>
                <li class="breadcrumb-item active"> Edit Categories</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Category
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $category['name'] ?>">
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

<?php
    include "layouts/footer.php";

}else{
    header('location: ../index.php');
}
?>






