<nav class="d-flex justify-content-end gap-3 nav-links"> 

	@guest
        @if (Route::has('register'))
            <a href="{{ route('login') }}">login</a>
			<a href="{{ route('register') }}">register</a>
		@endif
    @endguest

    @auth
    
        @if(auth()->user()->avatar)
            <img src="{{ auth()->user()->avatar['tiny'] }}" class="user-avatar" alt="{{ auth()->user()->name }}">
        @endif

		<a href="{{ route('user', auth()->user()->name) }}" class="username">
			@<strong>{{ auth()->user()->name }}</strong>
		</a>

        <div class="dropdown">
            <button class="btn btn-outline-info">Menu</button>
            
            <div class="dropdown-content">
                <a href="{{ route('profile.edit') }}">
                    profile
                </a>

                <a href="{{ route('posts.create') }}">
                    create post
                </a>

                <a href="{{ route('tags.create') }}">
                    create tag
                </a>

                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    log out
                </a>
            </div>

        </div>
          
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
			@csrf
		</form>
        
	@endauth

</nav>

