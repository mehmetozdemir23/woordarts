<x-layouts.account>
    <div class="tab-pane {{ Route::current()->getName() == 'account.addresses.index' ? 'active' : '' }}">
        <h4>Addresses</h4>
        <div class="d-flex align-items-start">
            <div>
                <div class="d-flex justify-content-start">
                    @foreach ($user_addresses as $user_address)
                        <div style="margin-right:20px;">
                            @if ($user_address->user_address_is_shipping)
                                <p class="text-primary m-0 text-info">default shipping address.</p>
                            @else
                                <p class="text-primary m-0 text-info invisible">blank</p>
                            @endif
                            <p class="mb-2"><strong>{{ Auth::user()->fullName() }}</strong>
                            </p>
                            <address>
                                @php
                                    $address = $user_address->address;
                                @endphp
                                <span class="mb-1 d-inline-block">{{ $address->address_line_1 }}</span>
                                <br>
                                @if ($address->address_line_2)
                                    <span class="mb-1 d-inline-block">{{ $address->address_line_2 }}</span>
                                    <br>
                                @endif
                                <span class="mb-1 d-inline-block">{{ $address->address_postal_code }}
                                    {{ $address->address_city }}</span>
                                <br>
                                <span>{{ $address->country->country_name }}</span>
                            </address>
                            <a href="{{ route('account.addresses.edit', ['address' => $user_address->id]) }}"
                                class="view">Edit</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</x-layouts.account>
