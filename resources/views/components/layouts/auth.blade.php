<x-layouts.app>

    {{-- <!-- breadcrumb-area start -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-12 text-center">
                    <h2 class="breadcrumb-title">Login & Register</h2>
                    <!-- breadcrumb-list start -->
                    <ul class="breadcrumb-list">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item active">Login</li>
                    </ul>
                    <!-- breadcrumb-list end -->
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area end --> --}}
    <!-- login area start -->
    <div class="login-register-area py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                    <div class="login-register-wrapper">
                        <div class="login-register-tab-list nav">
                            <a class="{{ Route::current()->getName() == 'auth.login.create' ? 'active' : '' }}" href="{{route('auth.login.create')}}">
                                <h4>login</h4>
                            </a>
                            <a class="{{ Route::current()->getName() == 'auth.register.create' ? 'active' : '' }}" href="{{route('auth.register.create')}}">
                                <h4>register</h4>
                            </a>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <div class="login-form-container">
                                    <div class="login-register-form">
                                        {{ $slot }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- login area end -->
</x-layouts.app>
