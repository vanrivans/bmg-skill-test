<script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

<div class="modal fade" id="modal-edit-article" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Edit Article</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form id="form-edit-article" entype="multipart/form-data">
            <input type="hidden" name="id" value="<?=$article['id'];?>">
            <div class="modal-body">
                <div class="form-group mb-3">
                    <label for="title_edit" class="col-form-label">Title:</label>
                    <input type="text" class="form-control" name="title_edit" id="title_edit" placeholder="Title" value="<?=$article['title'];?>">
                </div>
                <div class="form-group mb-3">
                    <label for="content_edit" class="col-form-label">Content:</label>
                    <textarea class="form-control content_edit" name="content_edit" id="content_edit"><?=$article['content'];?></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="article_category_edit" class="col-form-label">Category</label>
                    <div class="input-group">

                        <div class="input-group-prepend">
                            <input type="text" name="article_category_edit" id="article_category_edit"
                                    class="form-control form-left" placeholder="New Category" value="<?=$article['category'];?>">
                        </div>

                        <select id="select_category_edit" name="select_category_edit"
                                class="form-control">
                            <option value="" disabled>Select Category</option>
                            <option value="<?=$article['category_id'];?>" selected><?=$article['category'];?></option>

                            <?php foreach ($category as $row) :

                                if ($row->name != '') :
                                    echo '<option value="' . $row->id . '">' . $row->name . '</option>';
                                endif;

                            endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group mb-3">
                    <label for="tags_edit" class="col-form-label">Tag:</label>
                    <?php
                    $tags = '';
                    foreach (json_decode($article['tag_id'], TRUE) as $key => $value) {

                        if (isset($tagsData[$key])) {
                            $tags .= $tagsData[$key] . ', ';
                        }
                    }
                    ?>
                    <input type="text" name="tags_edit" class="form-control" id="tags_edit" value="<?=$tags;?>">
                </div>
                <div class="form-group mb-3">
                    <label for="thumbnail_edit" class="col-form-label">Change Thumbnail:</label>
                    <input type="file" name="thumbnail_edit" class="form-control" id="thumbnail_edit">
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

    $(document).ready( function ()  {

        $('#modal-edit-article').modal('show');
        $('#tags_edit').tagsInput({width:'auto'});

        $('#form-edit-article').validate({

            rules: {
                title_edit: {
                    required: true
                },
                article_category_edit: {
                    required: true
                }
            },
            messages: {
                title_edit: {
                    required: 'The title is required'
                },
                article_category_edit: {
                    required: 'The category is required'
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

                if ($('#content_edit').val() == '') {
                    
                    $('#content_edit').addClass('is-invalid').closest('.form-group').append('<span id="content-error" class="error invalid-feedback">The content is required</span>');

                    return false;
                }

                if ($('#tags_edit').val() == '') {
                    
                    $('#tags_edit').addClass('is-invalid').closest('.form-group').append('<span id="tags-error" class="error invalid-feedback">The tags is required</span>');

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

                        var form = $('#form-edit-article');
                        var formData = new FormData(form[0]);

                        $.ajax({
                            url: "<?=site_url('article/update_data');?>",
                            type: "post",
                            data: formData,
                            contentType: false,
                            processData: false,
                            // beforeSend: function() {
                            //     $('.modal-loading').modal('show');
                            // },
                            success: function(response) {
                                
                                // $('.modal-loading').modal('hide');

                                if (response == 'success') {

                                    setTimeout(function(){
                                        $('#modal-edit-article').modal('hide');
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

    $("body").on('hidden.bs.modal', function () {
        $('#display-edit').html('');
    });

    $('#select_category_edit').on('change', function (e) {

        var e       = document.getElementById('select_category_edit');
        var value   = e.options[e.selectedIndex].text;

        $('#article_category_edit').val(value);
	});

    $('#article_category_edit').on('change', function (e) {

        $("#select_category_edit")[0].selectedIndex = 0;
    });

    tinymce.init({
        selector: ".content_edit",
        plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak media",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
        ],
        toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image responsivefilemanager | media"
    });
</script>