<div class="sidebar" data-background-color="white" data-active-color="danger">

    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="{{ route("home") }}" class="simple-text">
                {{ config('app.name', 'Mano sandėlys') }}
            </a>
        </div>
        <ul class="nav">
            <li>
                <a href="javascript:void(0);">
                    <i class="ti-home"></i>
                    <p>Pagrindinis</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="ti-package"></i>
                    <p>Sandėlys</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="ti-shopping-cart"></i>
                    <p>Prekės</p>
                </a>
            </li>
            <li>
                <a href="javascript:void(0);">
                    <i class="ti-help-alt"></i>
                    <p>Pagalba</p>
                </a>
            </li>
            @auth
                <li>
                    <a href="javascript:void(0);" onclick="document.getElementById('user-logout-form').submit();">
                        <i class="ti-lock"></i>
                        <p>Atsijungti</p>
                    </a>
                    <form action="{{ route("logout") }}" method="POST" id="user-logout-form">
                        {{ csrf_field() }}
                    </form>
                </li>
            @endauth
        </ul>
    </div>
</div>