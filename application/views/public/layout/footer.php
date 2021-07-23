
<footer class="footer mt-auto">
    
    <div class="footer-navbar">
        <div class="row pt-5">
            <div class="col-2"></div>
            <div class="col-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">News</li>
                    <li class="list-group-item">E-shop</li>
                    <li class="list-group-item">About Us</li>
                </ul>
            </div>
            <div class="col-2">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Privacy Policy</li>
                    <li class="list-group-item">Guideline</li>
                    <li class="list-group-item">FAQ</li>
                    <li class="list-group-item">Contact Us</li>
                </ul>
            </div>
            <div class="col-4 p-0">
                <p style="font-family: var(--roboto-bold); font-size: 30px; line-height: 1">THE LATEST FROM US<br>
                <span style="font-family: var(--roboto-regular); font-size: 16px">Lorem ipsum dolor sit amet, consectetuer adipiscing.</span></p>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter your email">
                    <button class="btn" type="button">Sign Up</button>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
        <div class="row p-4">
            <div class="col-12 text-center">
                <p style="font-size: 18px">CONNECT WITH US</p>
                <img class="footer-icon" src="<?=base_url() . 'assets/icons/icon-fb-footer.png';?>">
                <img class="footer-icon" src="<?=base_url() . 'assets/icons/icon-ig-footer.png';?>">
                <img class="footer-icon" src="<?=base_url() . 'assets/icons/icon-twitter-footer.png';?>">
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        Copyright &copy; Lorem ipsum
    </div>

    <div class="offcanvas offcanvas-start" data-bs-backdrop="false" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body">
            <div style="padding-top: 125px">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">News</li>
                    <li class="list-group-item">Recipe</li>
                    <li class="list-group-item">Find Us</li>
                    <li class="list-group-item">About Us</li>
                    <li class="list-group-item">Contact Us!</li>
                </ul>
            </div>
            <div style="padding-top: 350px; padding-left: 1.25rem">
                <select id="language">
                    <option selected>English</option>
                    <option>Bahasa</option>
                </select>
            </div>
        </div>
    </div>

    <script>

        $(document).ready( function () {
            get_data_article();
        }); 

        function get_data_article() {

            $.ajax({
                url: "<?=site_url('ecofood/get_data');?>",
                type: "post",
                dataType: "json",
                beforeSend: function () {
                    $('#article-data').html('<div class="col-12 text-center"><div class="spinner-border ms-auto" role="status" aria-hidden="true"></div></div>');
                },
                success: function (data) {

                    $('#article-data').html('');

                    for (i = 0; i < data.length; i++) {
                        append_data(data[i]);
                    }

                    $('#article-data').append('<div class="col-12 text-center" style="font-size: 12px">Load more</div>');
                }
            });
        }

        function append_data(data) {

            var html = '<div class="col-6 pr-5 pb-3" onclick="detail(' + data.id + ')" role="button">';
            html += '<img src="<?=base_url();?>' + data.thumbnail.substring(2) + '" class="article-image">';
            html += '<div class="article-title pt-3 pb-2">';
            html += data.title;
            html += '</div>';
            html += '<div class="article-tag"></div>';
            html += '<div class="article-content">' + data.content.replace(/(<([^>]+)>)/gi, "").substring(0, 75) + '...</div>';
            html += '<!-- <div class="article-date">20 June 2021 - By Minako</div> -->';
            html += '</div>';

            $('#article-data').append(html);
        }

        function detail(id) {
            location.href = "<?=site_url('ecofood/detail');?>/" + id;
        }

        $('.offcanvas-trigger').on('click', function () {

            if ($('.offcanvas.offcanvas-start').hasClass('show')) {
                
                $('.offcanvas.offcanvas-start').removeClass('show');
                $('.offcanvas.offcanvas-start').css('visibility', 'hidden');

                $('#offcanvas-trigger-close').removeClass('d-block').addClass('d-none');
                $('#offcanvas-trigger-open').removeClass('d-none').addClass('d-block');
            } else {
                $('.offcanvas.offcanvas-start').addClass('show');
                $('.offcanvas.offcanvas-start').css('visibility', 'visible');

                $('#offcanvas-trigger-open').removeClass('d-block').addClass('d-none');
                $('#offcanvas-trigger-close').removeClass('d-none').addClass('d-block');
            }
        });

        $('.backto-top').on('click', function () {
            window.scrollTo(0, 0);
        });

    </script>

</footer>

</html>