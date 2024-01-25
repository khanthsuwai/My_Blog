<?php
    include "layouts/side_nav.php";
    require "../dbconnect.php";

    $sql = "SELECT posts.*,categories.name as c_name , users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $posts = $stmt->fetchAll(); 
    // var_dump($posts);
?>

    <main>
        <div class="container-fluid px-4">
            <div class="mt-3">
                <h1 class="mt-4 d-inline">Posts</h1>
                <a href="create_post.php" class="btn btn-lg btn-primary float-end">Create Post</a>
            </div>
            
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                <li class="breadcrumb-item active">Posts</li>
            </ol>
            <div class="card mb-4">
                <div class="card-header">
                    <i class="fas fa-table me-1"></i>
                    Posts
                </div>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>User</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                            <th>Title</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Action</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            <?php
                                foreach($posts as $post){

                            ?>
                                <tr>
                                    <td><?= $post['title'] ?></td>
                                    <td><?= $post['u_name'] ?></td>
                                    <td><?= $post['c_name'] ?></td>
                                    <td>
                                        <a href="../detail.php?postID=<?= $post['id']?>" class="btn btn-sm btn-outline-primary" target="_blank">Detail</a>
                                        <button class="btn btn-sm btn-outline-warning">Edit</button>
                                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                                    </td>
                                </tr>

                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

<?php
    include "layouts/footer.php";
?>
