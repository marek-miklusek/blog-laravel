<h4 class="profile-heading mb-1">Delete Account</h4>

<form method="POST" action="{{ route('profile.destroy') }}">
    @csrf
    @method('DELETE')
    <button class="btn btn-outline-danger">Delete</button>
</form>


