<x-layouts.auth>
    <form action="/register" method="post">
        @csrf
        <x-form.input name="user-username" placeholder="Username"/>
        <x-form.input name="user-firstname" placeholder="First name"/>
        <x-form.input name="user-lastname" placeholder="Last name"/>
        <x-form.input name="user-email" placeholder="Email"/>
        <x-form.input type="password" name="password" placeholder="Password"/>
        <x-form.input type="password" name="password_confirmation" placeholder="Confirm password"/>
        <div class="button-box">
            <button type="submit"><span>Register</span></button>
        </div>
    </form>
</x-layouts.auth>
