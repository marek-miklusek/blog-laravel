<h4 class="profile-heading">Update password</h4>

<form method="post" action="{{ route('password.update') }}" class="form-group">
    @csrf
    @method('put')

    <input name="current_password" type="password" placeholder="current password" autocomplete="current-password" />

    <input name="password" type="password" placeholder="new password" autocomplete="new-password" />

    <input name="password_confirmation" type="password" placeholder="confirm password" autocomplete="new-password" />

    <button class="btn btn-outline-info mt-2">Save</button>

</form>
