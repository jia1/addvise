<div class="nav-external" style="display: none;">
    <button id = "login" class="loginBtn loginBtn-facebook">
        Login with Facebook
    </button>
</div>

<div class="nav-internal" style="display: none;">
<nav>
    <ul>
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
</div>

<script>
function logoutPopUp() {
  alert("You are now logged out of Addvise. Have a great day ahead!");
}
</script>

