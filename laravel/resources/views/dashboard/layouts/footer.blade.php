<!--Footer -->
<footer id="footer">

</footer>
@include('dashboard.layouts.javascript')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    </script>
 @yield('javascript')
</body>
</html>
