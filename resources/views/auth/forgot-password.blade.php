<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <div>
        <label>Email</label>
        <input type="email" name="email" required />
    </div>

    <div>
        <label>Token Reset</label>
        <input type="text" name="token" required />
    </div>

    <div>
        <label>Password Baru</label>
        <input type="password" name="password" required />
    </div>

    <div>
        <label>Konfirmasi Password</label>
        <input type="password" name="password_confirmation" required />
    </div>

    <button type="submit">Reset Password</button>
</form>
