<div class="nav-external" style="display: none;">
    <button id = "login" class="loginBtn loginBtn-facebook">
        Login with Facebook
    </button>
</div>


<div class="nav-internal" style="display: none;">
    <nav>
        <ul id="fourth">
            <li>
                <!-- Welcome <div id="userName"></div> -->
            </li>
            <li>
                <a href="{{ url('home') }}">HOME</a>
            </li>
            <li>
                <a href="{{ url('ask') }}">ASK FOR ADVICE</a>
            </li>
            <li>
                <a href="{{ url('needAddvise') }}">GIVE AN ADVICE</a>
            </li>
            <li>
                <a href="{{ url('needAddvise/me') }}">MY REQUESTS</a>
            </li>
            <li>
                <a href="{{ url('needAddvise/advice/me') }}">ADVICE I GAVE</a>
            </li>
            <li>
                <a href="{{ url('policy') }}">ADDVISE POLICY</a>
            </li>
            <li>
                <a href="{{ url('me') }}">ME</a>
            </li>
            <li>
                <a class="logout" onclick="logoutPopUp()">LOGOUT</a>
            </li>
        </ul>
    </nav>

    <nav id="xo">
        <ul>
            <a style ="cursor:pointer; font-size: 200%;" onclick="dropit();">❤❤❤</a>
        </ul>
        <div id="dropdown" style="display:none;">
            <ul>
                <a href="{{ url('home') }}">HOME</a>
            </ul>
            <ul>
                <a href="{{ url('ask') }}">ASK FOR ADVICE</a>
            </ul>
            <ul>
                <a href="{{ url('needAddvise') }}">GIVE AN ADVICE</a>
            </ul>
            <ul>
                <a href="{{ url('needAddvise/me') }}">MY REQUESTS</a>
            </ul>
            <ul>
                <a href="{{ url('needAddvise/advice/me') }}">ADVICE I GAVE</a>
            </ul>
            <ul>
                <a href="{{ url('policy') }}">ADDVISE POLICY</a>
            </ul>
            <ul>
                <a href="{{ url('me') }}">ME</a>
            </ul>
            <ul>
                <a class="logout">LOGOUT</a>
            </ul>
        </div>
    </nav>
</div>

<style type="text/css">
    @media screen and (max-width: 1250px) {
        #login{
            position: relative;
            top: -50%;
        }

        #fourth{
            display: none;
        }

        #xo{
            display: block;
        }
    }

    @media screen and (min-width: 1251px) {
        #xo{
            display: none;
        }
    }


    #dropdown{
        font-size: 130%;
        display: none;
    }
</style>

<script type="text/JavaScript">
function dropit(){
    if(document.getElementById('dropdown').style.display === 'block'){
        document.getElementById('dropdown').style.display = 'none';
    }else{
        document.getElementById('dropdown').style.display = 'block';
    }
}
</script>

