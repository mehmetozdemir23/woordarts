<x-layouts.account>
    <div class="tab-pane fade show {{ Route::current()->getName() == 'account.dashboard' ? 'active' : '' }}">
        <h4>Dashboard </h4>
        <p>From your account dashboard. you can easily check &amp; view your <a href="#">recent
                orders</a>, manage your <a href="#">shipping and billing addresses</a> and <a
                href="#">Edit your password and account details.</a></p>
    </div>
</x-layouts.account>
