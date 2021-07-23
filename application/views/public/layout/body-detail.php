<link rel="stylesheet" href="<?=base_url();?>assets/custom/article-detail.css">

<body class="article-detail">

    <div class="container-fluid">

        <div class="row">

            <div class="sidebar col-sm-auto">

                <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center pt-3">

                    <a href="<?=site_url('ecofood');?>" class="d-block p-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
                        <img src="<?=base_url() . 'assets/icons/logo.png';?>">
                    </a>
                </div>
                <div class="pushmenu">

                    <a class="nav-link d-block offcanvas-trigger" id="offcanvas-trigger-open" role="button">
                        <img src="<?=base_url() . 'assets/icons/icon-menu-burger.png';?>" style="margin: 0 1rem">
                    </a>

                    <a class="nav-link border-left d-none offcanvas-trigger" id="offcanvas-trigger-close" role="button">
                        <img src="<?=base_url() . 'assets/icons/icon-close.png';?>" style="margin: 0 1rem">
                    </a>
                </div>

                <div class="backto-top" role="button" aria-label="Scroll to top">Back to top</div>

            </div>
            <div class="content col-sm p-0">

                <div class="top-navbar">
                
                    <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#" style="padding-left:0">Lorem ipsum</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#">Dolor</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#">Sit amet</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#">Sed diam</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#">Dolore</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link link-white" href="#">Magna</a>
                                </li>
                            </ul>   
                            <ul class="navbar-nav mb-2 mb-lg-0 navbar-right">
                                <li class="nav-item d-inline">
                                    <a class="nav-link link-white" href="#">
                                        <img src="<?=base_url() .  'assets/icons/icon-search-green.png';?>">
                                    </a>
                                </li>
                                <li class="nav-item d-inline dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?=base_url() .  'assets/icons/icon-profile-green.png';?>">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Login</a></li>
                                        <li><a class="dropdown-item" href="#">Register</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>
                
                <div class="content">

                    <div class="breadcrumb">
                        News > Lorem ipsum > detail news
                    </div>

                    <div class="row pt-3 pb-3">
                        <div class="col-7">
                            <img src="<?=base_url() . substr($article['thumbnail'], 2);?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4 detail-article-title">
                            <?=$article['title'];?>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-2 pt-4 pb-4 detail-article-date">
                            <?=date('d M Y', strtotime($article['created_time']));?>
                        </div>

                    </div>

                    <div class="row" style="margin-bottom: 3rem">
                        <div class="col-2"></div>

                        <div class="col-6 pb-4" style="padding-right: 3rem; font-size: 12px">

                            <?=$article['content'];?>

                            <p>By: Minako</p>

                            <div class="row">
                                <div class="col-12 article-tools">
                                    <div class="d-inline">
                                        <img src="<?=base_url() . 'assets/icons/icon-comment.png';?>"> Comment
                                    </div>
                                    <div class="float-right d-inline">
                                        <span style="padding: 0 .5rem">Share</span>
                                        <img src="<?=base_url() . 'assets/icons/icon-fb-article.png';?>" class="icon-article">
                                        <img src="<?=base_url() . 'assets/icons/icon-twitter-article.png';?>" class="icon-article">
                                        <img src="<?=base_url() . 'assets/icons/icon-wa-article.png';?>" class="icon-article">
                                        <img src="<?=base_url() . 'assets/icons/icon-share-link-article.png';?>" class="icon-article">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 pt-4 pb-4" style="font-family: var(--roboto-bold)">
                                    1 Coment
                                </div>
                            </div>

                            <div class="row mb-4">
                                <div class="col-2">
                                    <img src="<?=base_url() . 'assets/icons/icon-profile-comment.png';?>">
                                </div>
                                <div class="col-10">
                                    <textarea class="textarea-comment d-block w-100" rows="5"></textarea>
                                    <button class="btn btn-post d-block">Post</button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-2">
                                    <img src="<?=base_url() . 'assets/icons/icon-profile-comment.png';?>">
                                </div>
                                <div class="col-10" style="font-size: 10px">
                                    <span style="color: var(--yellow-green)">Username</span><br>
                                    <p class="m-0">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper</p>
                                    <span style="color: var(--yellow-green)">Reply 10m</span>
                                </div>
                            </div>
                            
                        </div>

                        <div class="col-trending col-3">
                            <h5 class="title-trending">Trending</h5>
                            <ul class="list-group list-group-flush">

                                <?php
                                for ($i = 0; $i < count($trending); $i++) : 

                                    $number = $i + 1;
                                    ($number < 10) ? $number = '0' . $number : $number = $number;
                                    
                                    echo '<li class="list-group-item">';
                                        echo '<span class="list-number">' . $number . '</span>';
                                        echo '<span class="list-title">' . $trending[$i] . '</span>';
                                    echo '</li>';
                                endfor;
                                ?>
                            </ul>
                        </div>
                    </div>

                    <div class="row" style="margin-bottom: 5rem">
                        <div class="col-2"></div>

                        <div class="col-8">

                            <div class="row">
                                <h2 style="color: var(--yellow-green); padding: .5rem 0; font-family: var(--roboto-bold)">GO TO THE NEWS PAGE ___</h2>
                            <?php
                            foreach ($news as $row) :
                                
                                echo '<div class="col-6 pr-5 pb-3">
                                    <img src="' . base_url() . substr($row->thumbnail, 2) . '" class="article-image">
                                    <div class="article-title pt-3 pb-2">' . $row->title . '</div>
                                    <div class="article-tag"></div>
                                    <div class="article-content">' . substr(strip_tags($row->content), 0, 75) . '...</div>
                                </div>';
                            endforeach;
                            ?>
                            </div>
                        </div>

                    </div>

                    <div class="contact-me">
                        <img src="<?=base_url() . 'assets/icons/icon-chat.png';?>">
                    </div>

                </div>

            </div>

        </div>

    </div>

</body>
