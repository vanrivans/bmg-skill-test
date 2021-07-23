<body>

    <div class="container-fluid">

        <div class="row">

            <div class="sidebar col-sm-auto">

                <div class="d-flex flex-sm-column flex-row flex-nowrap align-items-center pt-3">

                    <a href="/" class="d-block p-3" title="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-original-title="Icon-only">
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

                <div class="top-banner">
                
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
                                        <img src="<?=base_url() .  'assets/icons/icon-search.png';?>">
                                    </a>
                                </li>
                                <li class="nav-item d-inline dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <img src="<?=base_url() .  'assets/icons/icon-profile.png';?>">
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="#">Login</a></li>
                                        <li><a class="dropdown-item" href="#">Register</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </nav>

                    <div class="homepage-content">
                        
                        <div class="quote-content">
                            Lorem Ipsum Dolor<br>
                            Adipiscing Elit Sit Amet
                            <p style="font-family: var(--roboto-regular)">20 June 2021 &#183; By Minako<p>
                        </div>
                        <button class="btn-readmore">Read More</button>

                    </div>
                </div>
                
                <div class="content">

                    <h2 class="title-header">THE LASTEST __________</h2>

                    <div class="row">
                        <div class="col-8 pt-4 pb-4">

                            <div class="row" id="article-data">
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
                </div>

                <div class="contact-me">
                    <img src="<?=base_url() . 'assets/icons/icon-chat.png';?>">
                </div>

            </div>

        </div>

    </div>

</body>
