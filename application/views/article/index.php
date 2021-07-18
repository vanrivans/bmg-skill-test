
<style>
    .float-right {
        float: right
    }
    .flex-shrink-0 {
        padding: 80px;
    }
    main > .container {
        padding: 15px;
    }
    .b-default {
        border: 1px solid #eaeaea;
    }
    .more {display: none;}
    .thumbnail {
        width: 10em;
        height: auto;
    }
</style>

<main class="flex-shrink-0">

    <div class="container b-default">

        <div class="col-12">
            <button class="btn btn-success float-right" id="btn-add" data-bs-toggle="modal" data-bs-target="#modal-add-article">New Data</button>
        </div>

        <h1>Article</h1>

        <p class="lead">

            <table class="table table-sm" id="table-article">
                <thead>
                    <tr>
                        <th>Created Time</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Thumbnail</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>

        </p>

    </div>

</main>

<div id="display-edit"></div>

<div class="modal fade" id="modal-add-article" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="form-add-article" entype="multipart/form-data">
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                </div>
                <div class="form-group mb-3">
                    <label for="content" class="col-form-label">Content:</label>
                    <textarea class="form-control" name="content" id="content"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="article_category" class="col-form-label">Category</label>
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <input type="text" name="article_category" id="article_category"
                                    class="form-control form-left" placeholder="New Category">
                        </div>

                        <select id="select_category" name="select_category"
                                class="form-control">
                            <option value="" selected disabled>Select Category</option>

                            <?php foreach ($category as $row) :

                                if ($row->name != '') :
                                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                                endif;

                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="tags" class="col-form-label">Tag:</label>
                    <input type="text" name="tags" class="form-control" id="tags">
                </div>
                <div class="form-group mb-3">
                    <label for="thumbnail" class="col-form-label">Thumbnail:</label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            </form>
        </div>
    </div>

</div>

<script>

    var tableArticle = $('#table-article').DataTable({

        // Data
        ajax: {
            url: "<?=site_url('article/server_side_data');?>",
            type: "POST"
        },
        processing: true,
        paging: false,
        searching: false,
        info: false,
        order: [0, 'desc'],
        colReorder: true,
        scrollCollapse: true
    });

    $('#select_category').on('change', function (e) {

        var e       = document.getElementById('select_category');
        var value   = e.options[e.selectedIndex].text;

        $('#article_category').val(value);
	});

    $('#article_category').on('change', function (e) {

        $("#select_category")[0].selectedIndex = 0;
    });

    $(document).ready( function ()  {

        $('#tags').tagsInput({width:'auto'});

        $('#form-add-article').validate({

            rules: {
                title: {
                    required: true
                },
                article_category: {
                    required: true
                },
                thumbnail: {
                    required: true
                }
            },
            messages: {
                title: {
                    required: 'The title is required'
                },
                article_category: {
                    required: 'The category is required'
                },
                thumbnail: {
                    required: 'The thumbnail is required'
                }
            },
            errorElement: 'span',
            errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            },
            submitHandler: function () {

                if ($('#content').val() == '') {
                    
                    $('#content').addClass('is-invalid').closest('.form-group').append('<span id="content-error" class="error invalid-feedback">The content is required</span>');

                    return false;
                }

                if ($('#tags').val() == '') {
                    
                    $('#tags').addClass('is-invalid').closest('.form-group').append('<span id="tags-error" class="error invalid-feedback">The tags is required</span>');

                    return false;
                }

                Swal.fire({
                    title: 'Save data, are you sure?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#007bff',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Submit!'
                    }).then((result) => {

                    if (result.isConfirmed) {

                        var form = $('#form-add-article');
                        var formData = new FormData(form[0]);

                        $.ajax({
                            url: "<?=site_url('article/save_data');?>",
                            type: "post",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                $('.modal-loading').modal('show');
                            },
                            success: function(response) {

                                $('.modal-loading').modal('hide');

                                if (response == 'success') {

                                    setTimeout(function(){
                                        $(form)[0].reset();	
                                        $('#modal-add-article').modal('hide');
                                    }, 1000);

                                    setTimeout(function(){
                                        tableArticle.ajax.reload();
                                    }, 1500);

                                    Swal.fire({
                                        position: 'center',
                                        icon: 'success',
                                        title: 'Data berhasil disimpan',
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                                } else if (response == 'upload-error') {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: "Can't upload image!"
                                    });
                                } else if (response == 'error') {

                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Something wrong!'
                                    });
                                }
                            }
                            // End of success
                        });
                        // End of ajax submit
                    }
                });
            }
            // End of submitHandler

        });
    });

    tinymce.init({
        selector: "#content",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak media",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | media"
    });

    function readmore(id) {
        var dots = document.getElementById("dots" + id);
        var moreText = document.getElementById("more" + id);
        var btnText = document.getElementById("readmore" + id);

        if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "read more";
            moreText.style.display = "none";
        } else {
            dots.style.display = "none";
            btnText.innerHTML = "read less";
            moreText.style.display = "inline";
        }
    }

    function edit_article(id)  {

        $.ajax({
            url: "<?=site_url('article/show_edit');?>",
            method: "post",
            data: {
                id: id
            }, 
            beforeSend: function () {
                $('.modal-loading').modal('show');
            },
            success: function (html) {
                $('.modal-loading').modal('hide');

                $('#display-edit').html(html);
            }
        });
    }

    function delete_article(id) {

        Swal.fire({
            title: 'Delete data, are you sure?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#007bff',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Submit!'
            }).then((result) => {

            if (result.isConfirmed) {

                $.ajax({
                    url: "<?=site_url('article/delete_data');?>",
                    method: "post",
                    data: {
                        id: id
                    }, 
                    beforeSend: function () {
                        $('.modal-loading').modal('show');
                    },
                    success: function () {
                        $('.modal-loading').modal('hide');

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Data berhasil dihapu',
                            showConfirmButton: false,
                            timer: 1500
                        });

                        setTimeout(function(){
                            tableArticle.ajax.reload();
                        }, 1500);
                    }
                });
            }
        });
    }

</script>