<footer class="footer">
    <div class="container-fluid">
        <nav class="pull-left">
            <ul></ul>
        </nav>
        <div class="copyright pull-right">
            &copy; {{ \Carbon\Carbon::now()->year }},
            @if(config("app.reason") == "UX") Nikolajus Lebedenko @else {{ config("app.name") }}  @endif
        </div>
    </div>
</footer>