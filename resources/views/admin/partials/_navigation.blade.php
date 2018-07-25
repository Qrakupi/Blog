<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-center">
        <ul class="uk-navbar-nav" style="margin:auto">
            <li class="{{$_SERVER['REQUEST_URI']=='/admin'?'uk-active':''}}"><a href="/admin">Home</a></li>
            <li class="{{$_SERVER['REQUEST_URI']=='/admin/posts'?'uk-active':''}}"><a href="admin/posts">Posts</a></li>
            <li><a href="#">Another</a></li>
            <li><a href="#">Another</a></li>
        </ul>
    </div>
</nav>
