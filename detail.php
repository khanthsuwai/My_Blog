<?php
    include "layouts/navbar.php";
    require "dbconnect.php";

    $id = $_GET['postID'];
    // echo $id;

    $sql = "SELECT posts.*,categories.name as c_name , users.name as u_name FROM posts INNER JOIN categories ON categories.id = posts.category_id INNER JOIN users ON users.id = posts.user_id WHERE posts.id = :post_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':post_id', $id); //parameter ပါတဲ့ဟာတွေဆို bindParam လုပ်ပေးဖို့လိုတယ် ပိုပြီးတော့  secure ဖစ်အောင်
    $stmt->execute();
    $post = $stmt->fetch(PDO::FETCH_ASSOC);
    $timestamp = strtotime($post['created_at']);

    // var_dump($post);
?>
        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Post content-->
                    <article>
                        <!-- Post header-->
                        <header class="mb-4">
                            <!-- Post title-->
                            <h1 class="fw-bolder mb-1"><?= $post['title']?></h1>
                            <!-- Post meta content-->
                            <div class="text-muted fst-italic mb-2">Posted on <?= date('d M,Y', $timestamp) ?>  by <?= $post['u_name']?></div>
                            <!-- Post categories-->
                            <a class="badge bg-secondary text-decoration-none link-light" href="#!"><?= $post['c_name'] ?></a>
                        </header>
                        <!-- Preview image figure-->
                        <figure class="mb-4"><img class="img-fluid rounded" src="<?= $post['image']?>" alt="..." /></figure>
                        <!-- Post content-->
                        <section class="mb-5">
                        <?= $post['description']?>
                        </section>
                    </article>
                </div>
<?php
    include "layouts/footer.php";
?>
