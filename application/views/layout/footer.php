<!-- <footer class="footer mt-auto py-3 bg-light">
    <div class="container">
        <span class="text-muted">Footer</span>
    </div>
</footer> -->

    <div id="modal-placehorder"></div>

    <div class="modal modal-loading" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered">
            <div class="row" style="margin-left:auto;margin-right:auto">
                <div class="col-12 text-center">
                    <div class="spinner-border ms-auto" role="status" aria-hidden="true"></div>
                </div>
            </div>
        </div>
        <!--/.modal-dialog -->

    </div>
    <!--/.modal.modal-loading -->

    <script>
        $(function () {

            $(document).on('click', '#btn-signout', function () {
                $('div#modal-placehorder').load("<?=site_url('dashboard/load_modal_sign_out');?>");
            });
        });
    </script>

</body>
</html>
