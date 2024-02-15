<?php

session_start();

if(isset($_SESSION['user_id'])){
    
    require "../dbconnect.php";

    $id = $_GET['postID'];

    $sql = "SELECT posts.*,categories.name as c_name , users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.user_id WHERE posts.id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($post);
    // die();

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // ထည့်လိုက်တဲ့ input data တွေကိုလက်ခံတာ

        $title = $_POST['title'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $user_id = $_POST['user_id'];
        $old_image = $_POST['old_image'];
        $image_array = $_FILES['image'];

        // echo "$title and $category_id and  $user_id and $description and $old_image";
        // print_r($image_array);
        // die();

        // File upload

        if(isset($image_array) && $image_array['size'] > 0){
            $folder_name = "images/";
            $image_path = $folder_name.$image_array['name']; //images/123.png

            $tmp_name = $image_array['tmp_name'];
            move_uploaded_file($tmp_name,$image_path);
        }else{
            $image_path = $old_image;
        }

        $sql = "UPDATE posts SET title=:title , image=:image_path, user_id=:user_id,category_id=:category_id,description=:description WHERE id=:id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);

        $stmt->execute();

        header("location: posts.php");
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
                <h1 class="mt-4 d-inline"> Edit Posts</h1>
                <a href="posts.php" class="btn btn-lg btn-danger float-end">Cancel</a>
            </div>
            
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="posts.php">Posts</a></li>
                <li class="breadcrumb-item active">Edit Posts</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Edit Posts
                </div>
                <div class="card-body">
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= $post['title'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="category_id">Categories</label>
                            <select class="form-select" id="category_id" name="category_id" aria-label="Default select example">
                            <option selected>Choose....</option>
                            <?php 
                                foreach($categories as $category){

                                    // Ternary Operator
                                    // (Condition) ? (Statement1) : (Statement2);

                                    // if($post['category_id'] == $category['id']){
                                    //     echo "selected";
                                    // }else{
                                    //     echo '';
                                    // }

                                    // or

                                    // echo $post['category_id'] == $category['id'] ? "selected" : '';
                                ?>
                            <option value="<?= $category['id'] ?>"<?php echo $post['category_id'] == $category['id'] ? "selected" : ''; ?>><?= $category['name'] ?></option>
                            <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image-tab-pane" type="button" role="tab" aria-controls="image-tab-pane" aria-selected="true">Image</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="newImage-tab" data-bs-toggle="tab" data-bs-target="#newImage-tab-pane" type="button" role="tab" aria-controls="newImage-tab-pane" aria-selected="false">New Image</button>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="image-tab-pane" role="tabpanel" aria-labelledby="image-tab" tabindex="0">
                                        <img src="<?= $post['image'] ?>" class="my-3 w-50 h-50" alt=""> 
                                        <input type="hidden" name="old_image" id="" value="<?= $post['image'] ?>">
                                </div>

                                <div class="tab-pane fade" id="newImage-tab-pane" role="tabpanel" aria-labelledby="newImage-tab" tabindex="0">
                                    <input type="file" class="form-control my-3" id="image" name="image">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="description"><?= $post['description'] ?></textarea>
                        </div>
                        <input type="hidden" name="user_id" id="" value="<?= $post['user_id'] ?>">
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
