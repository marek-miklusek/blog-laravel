<h4 class="profile-heading">Delete Account</h4>

<form method="POST" action="/profile">
    @csrf
    @method('delete')

    <button class="btn btn-outline-info">Delete</button>
</form>


