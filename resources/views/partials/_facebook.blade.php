<!-- Warning: _head.blade.php also includes jQuery -->

<script
src="https://code.jquery.com/jquery-3.2.1.min.js"
integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
crossorigin="anonymous"></script>

<script>
function getUserName(callback){
    FB.api('/me', function(response) {
        callback(response.name);
    });
}

function getProfilePicture(callback){
    FB.api('/me/picture?type=normal', function(response) {
        callback(response.data.url);
    });
}
</script>

<script>
$(document).ready(function() {
    $.ajaxSetup({ cache: true });
    $.getScript('//connect.facebook.net/en_US/sdk.js', function(){
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
                $('#mainNav').hide();

                $('.logout').click(function(response) {
                    FB.logout();
                    window.location.replace("/");
                    $('.nav-internal').hide();
                    $('.nav-external').show();
                });
            } else {
                // Either:
                // Is logged in to Facebook but has not authorized this app, OR
                // Is not logged in to Facebook
                $('.nav-external').show();
                $('#login').click(function() {
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

        // Translate FB user IDs to names
        setTimeout(function () {
            translateFB(FB);
        }, 3000);
    });
});
</script>

