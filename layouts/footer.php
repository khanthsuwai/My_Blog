<?php
    require "dbconnect.php";

    $sql = "SELECT * FROM categories";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $categories = $stmt->fetchAll();
    // var_dump($categories);

?>
    <!-- Categories widget-->
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <?php
                                    foreach($categories as $category){

                                ?>
                                <li><a href="index.php?cid=<?= $category['id'] ?>"><?= $category['name'] ?></a></li>
                                <?php } ?>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        
    <!-- index.php နဲ့ detail.php နဲ့ရဲ့  container နဲ့ row div အပိတ် -->
    </div>
    </div>
        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; All right reversed 2024</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
