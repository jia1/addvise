<script>

window.fbAsyncInit = function() {
    FB.init({
        appId : '1592283090803235',
            autoLogAppEvents : true,
            cookies          : true,
            status           : false,
            xfbml            : true,
            version          : 'v2.10'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
        console.log(response);
        if (response.status === 'connected') {
            // Is logged in to Facebook and has authorized this app
            $('.top-right.links').html('<a href="#">Home</a>');
        } else if (response.status === 'not_authorized') {
            // Is logged in to Facebook but has not authorized this app
            $('.top-right.links').html('<a id="login">Login with Facebook</a>');
        } else {
            // Is not logged in to Facebook
            FB.Event.subscribe('auth.statusChange', function(response) {
                console.log(response);
            });
            $('.top-right.links').html('<a id="login">Login with Facebook</a>');
        }
        $('#login').click(function() {
            FB.login(function(response) {
                console.log(response);
                window.location.replace("{{ url('/') }}");
            }, {
                scope: 'email',
                    return_scopes: true,
            });
        });
    }, true);


};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



</script>

