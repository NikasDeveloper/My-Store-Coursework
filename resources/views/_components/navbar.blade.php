<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar bar1"></span>
                <span class="icon-bar bar2"></span>
                <span class="icon-bar bar3"></span>
            </button>
            <a class="navbar-brand" href="javascript: void(0);">@yield("title")</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                @auth
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <i class="ti-pencil-alt"></i>
                            <p>Veiksmai</p><b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route("product.create") }}">Sukurti prekę</a></li>
                            <li><a href="javascript: void(0);">Papildyti sandėlį</a></li>
                        </ul>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>