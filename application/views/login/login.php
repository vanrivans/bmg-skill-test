<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Login | Management Article</title>

    <!-- Bootstrap core CSS -->
    <link href="<?=base_url();?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url();?>assets/custom/login.css" rel="stylesheet">

</head>
<body class="text-center">
    
    <main class="form-signin">
    <form id="form-signin" action="<?=site_url('login');?>" method="post">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="col-12">
            <?=$this->layout_lib->load_view('layout/alerts');?>
        </div>

        <div class="form-floating">
        <input type="text" class="form-control" name="username" id="username" placeholder="username" autofocus>
        <label for="username">Username</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
        <label for="password">Password</label>
        </div>
        
        <input type="hidden" name="btn-login" value="true">

        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2021</p>
    </form>
    </main>
    
</body>
</html>
