<script>

window.fbAsyncInit = function() {
    FB.init({appId : '1592283090803235',
        autoLogAppEvents : true,
        cookie           : true,
        status           : true,
        xfbml            : true,
        version          : 'v2.10'
    });
    FB.AppEvents.logPageView();

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // Is logged in to Facebook and has authorized this app
            $('.nav-internal').show();
            $('.logout').click(function(response) {
                FB.logout();
                window.location.replace("/");
            });
        } else {
            // Either:
            // Is logged in to Facebook but has not authorized this app, OR
            // Is not logged in to Facebook
            $('.nav-external').show();
            $('.login').click(function() {
                FB.login(function(response) {
                    if (response.authResponse) {
                        window.location.replace("{{ url('home') }}");
                    } else {
                        alert("Facebook login failure. You closed the login window, right?");
                    }
                }, {scope: 'public_profile,email',
                    return_scopes: true
                });
            });
        }
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>

