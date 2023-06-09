<h4 class="profile-heading">Update username</h4>

<form method="POST" action="{{ route('profile.update') }}" class="form-group">
    @csrf
    @method('PATCH')
    <input name="name" type="text" value="{{ $user->name }}" required autofocus autocomplete="name"/>
    <input name="email" type="email" value="{{ $user->email }}" required autocomplete="username" />
    <p class="mb-0"><button class="btn btn-outline-success mt-2">Save</button></p>
</form>
