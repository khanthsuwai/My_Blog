                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>

        <script>
            $('#description').summernote({
                placeholder: 'Hello stand alone ui',
                tabsize: 2,
                height: 120,
                toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $(document).ready(function(){
                $('tbody').on('click','.delete',function(){
                    // alert("hello");
                    let id = $(this).data('post_id');
                    console.log(id);
                    $('#postID').val(id);
                    $('#deleteModal').modal('show');
                })

                $('tbody').on('click','.categorydelete',function(){
                    let category_id = $(this).data('category_id');
                    console.log(category_id);
                    $('#categoryID').val(category_id);
                    $('#categoryDelete').modal('show');
                })

                $('tbody').on('click','.userdelete',function(){
                    let user_id = $(this).data('user_id');
                    console.log(user_id);
                    $('#userID').val(user_id);
                    $('#userDelete').modal('show');

                })
            })
        </script>
    </body>
</html>
