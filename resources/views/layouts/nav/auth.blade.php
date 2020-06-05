<li class="nav-item">
    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="fas fa-sign-out-alt"></i> Sign Out
    </a>
</li>

<form id="logout-form" method="post" action="{{ route('logout') }}" style="display: none;">
    @csrf
</form>
