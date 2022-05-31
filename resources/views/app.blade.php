@include('partials.header')
@include('partials.navbar')
@include('partials.menu')
@include('partials.errors')
@yield('content')
@include('partials.footer')
@yield('script')

<script>
    var logOutTimeOut=null;
    $('html').on('keyup mousemove', function(e){
        clearTimeout(logOutTimeOut);
        logOutTimeOut=setTimeout(function(){
            location.replace("{{action('Auth\AuthController@getLogoutRemember')}}");
        },900000)
    }).trigger('keyup');
</script>