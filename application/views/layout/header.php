<!doctype html>
<html lang="en" class="h-100">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title><?=$title . ' | ' . $appName;?></title>

    <!-- START STYLES -->

    <!-- Bootstrap v5.0.2 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css?v5.0.0">

    <!-- Sweetalert2 v10.3.5 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/sweetalert2/dist/sweetalert2.min.css?v10.3.5">

    <!-- DataTables v1.10.22 -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/datatables/datatables/css/dataTables.bootstrap5.min.css">

    <!-- Tagsinput -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendor/jquery-tags-input/jquery.tagsinput.css">

    <!-- END STYLES -->

    <!-- START PLUGINS -->

    <!-- jQuery v3.5.1 -->
    <script src="<?=base_url();?>assets/vendor/jquery/jquery-3.5.1.min.js?v3.5.1"></script>

    <!-- Bootstrap v5.0.2 -->
    <script src="<?=base_url();?>assets/bootstrap/js/bootstrap.min.js?v5.0.0"></script>

    <!-- jQuery Validate v1.19.2 -->
    <script src="<?=base_url();?>assets/vendor/jquery-validation/dist/jquery.validate.min.js?v1.19.2"></script>

    <!-- Sweetalert2 v10.3.5 -->
    <script src="<?=base_url();?>assets/vendor/sweetalert2/dist/sweetalert2.min.js?v10.3.5"></script>
    
    <!-- DataTables v1.10.22 -->
    <script src="<?=base_url();?>assets/vendor/datatables/datatables/js/jquery.dataTables.min.js"></script>
    <script src="<?=base_url();?>assets/vendor/datatables/datatables/js/dataTables.bootstrap5.min.js"></script>

    <!-- Tagsinput -->
    <script src="<?=base_url();?>assets/vendor/jquery-tags-input/jquery.tagsinput.js"></script>

    <!-- Tiny MCE -->
    <script src="https://cdn.tiny.cloud/1/nrkw869s0t8rcalrzwsg21q5m8ss0je5gry7g6yz2rtrfh8m/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- END PLUGINS -->

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }
    
    main > .container {
        padding: 60px 15px 0;
    }
    
    .form-control.form-left {
        border-bottom-right-radius: 0;
        border-top-right-radius: 0;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>

</head>

<body class="d-flex flex-column h-100">
