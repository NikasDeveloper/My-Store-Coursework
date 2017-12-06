<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route("home") }}" class="simple-text">
                <img src="{{ asset("images/logo_small.png") }}" alt="">
            </a>
        </div>
        <ul class="nav">
            <li class="{{ activeClassBind(1, null) }}">
                <a href="{{ route("home") }}">
                    <i class="ti-home"></i><p>Pagrindinis</p>
                </a>
            </li>
            <li class="{{ activeClassBind(1, "store") }}">
                <a href="{{ route("store") }}">
                    <i class="ti-package"></i><p>Sandėlys</p>
                </a>
            </li>
            <li class="{{ activeClassBind(1, "products") }}">
                <a href="{{ route("products") }}">
                    <i class="ti-shopping-cart"></i><p>Prekės</p>
                </a>
            </li>
            @if(config("app.reason") == "UX")
            <li class="{{ activeClassBind(1, "help") }}">
                <a href="{{ asset("help.pdf")}}" download="help.pdf" target="_blank">
                    <i class="ti-help-alt"></i><p>Pagalba</p>
                </a>
            </li>
            @endif
            @auth
                <li>
                    <a href="javascript:void(0);" onclick="document.getElementById('user-logout-form').submit();">
                        <i class="ti-lock"></i><p>Atsijungti</p>
                    </a>
                    <form action="{{ route("logout") }}" method="POST" id="user-logout-form">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</div>