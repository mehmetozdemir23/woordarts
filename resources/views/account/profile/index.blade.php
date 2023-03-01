<x-layouts.account>
    @if (session('success') && now()->lt(session('success_expiration')))
        <div class="fixed-top alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @if (session('error') && now()->lt(session('error_expiration')))
        <div class="alert alert-danger">
            {{session('error')}}
        </div>
    @endif
    <div class="tab-pane fade {{ Route::current()->getName() == 'account.profile.index' ? 'active' : '' }}"
        id="account-details">
        <h3>Account details </h3>
        <div class="login">
            <div class="login_form_container">
                <div class="account_login_form">
                    <form action="{{route('account.profile.update')}}" method="post">
                        @csrf

                        <x-form.input label="Username" name="user-username" value="{{Auth::user()->username }}"/>

                        <x-form.input label="First name" name="user-firstname" value="{{Auth::user()->firstname }}"/>

                        <x-form.input label="Last name" name="user-lastname" value="{{Auth::user()->lastname }}"/>

                        <x-form.input label="Email" name="user-email" value="{{Auth::user()->email }}" disabled=true/>

                        <x-form.input type="password" label="Change password" name="password"/>

                        <x-form.input type="password" label="Confirm password" name="password_confirmation"/>

                        <div class="save_button mt-3">
                            <button class="btn" type="submit">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layouts.account>
