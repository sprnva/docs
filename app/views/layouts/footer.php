</div>
</div>
</div>
</div>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
    </div>
</aside>
<!-- /.control-sidebar -->

<!-- Main Footer -->
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
    </div>
    <!-- Default to the left -->
    <strong>&copy; 2021-<?= date('Y'); ?> <a href="https://github.com/sprnva/sprnva">Sprnva</a>.</strong> All rights reserved
</footer>
</div>


<!-- Bootstrap 4 -->
<script src="<?= public_url('/assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= public_url('/assets/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src="<?= public_url('/assets/adminlte/js/adminlte.min.js') ?>"></script>
<script>
    // $("pre code").addClass("language-php");
    document.querySelectorAll('pre code').forEach(el => {
        // then highlight each
        hljs.highlightElement(el);
    });

    function darkMood() {

        var _bdy = document.body;
        
        if(session_dm == 1){
            localStorage.setItem('dark-mode', 0);
        }else{
            localStorage.setItem('dark-mode', 1);
        }

        _bdy.classList.toggle("dark-mode");
    }
</script>
</body>

</html>