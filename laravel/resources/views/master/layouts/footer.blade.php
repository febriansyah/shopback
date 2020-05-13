

</div>
<!-- /.wrapper -->
<script type="text/javascript" src="{{ asset('backend/js/main.js') }}"></script>
    <script type="text/javascript" src="{{ asset('backend/js/vendor.js') }}"></script>

    <script type="text/javascript" src="http://kenwheeler.github.io/slick/slick/slick.js"></script>
    <script type="text/javascript" src="{{ asset('backend/js/app.js') }}"></script>

    <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ajaxSuccess(function( event, request, settings, data) {
        if (typeof data['redirect_auth'] !== 'undefined') {
            window.location = data['redirect_auth'];
            return;
        }
    });

    </script>

    @yield('script')
    @stack('script')
</body>
</html>
