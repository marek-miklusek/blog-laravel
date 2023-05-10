<h4 class="profile-heading">Update password</h4>

<form method="POST" action="{{ route('password.update') }}" class="form-group">
    @csrf
    @method('PUT')

    <input name="current_password" type="password" placeholder="current password" autocomplete="current-password" />
    <input name="password" type="password" placeholder="new password" autocomplete="new-password" />
    <input name="password_confirmation" type="password" placeholder="confirm password" autocomplete="new-password" />
    <p class="mb-0"><button class="btn btn-outline-success mt-2">Save</button></p>

</form>
