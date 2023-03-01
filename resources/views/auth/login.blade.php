<x-layouts.auth>
    <form action="{{route('auth.login.store')}}" method="post">
        @csrf
        <input type="text" name="email" placeholder="Email" />
        <input type="password" name="password" placeholder="Password" />
        <div class="button-box">
            <div class="login-toggle-btn">
                <input type="checkbox" />
                <a class="flote-none" href="javascript:void(0)">Remember me</a>
                <a href="#">Forgot Password?</a>
            </div>
            <button type="submit"><span>Login</span></button>
        </div>
    </form>
</x-layouts.auth>
