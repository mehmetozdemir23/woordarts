<x-layouts.account>
    <div style="margin-right:20px;">
        <p class="mb-2"><strong>{{ Auth::user()->fullName() }}</strong>
        </p>
        <address>
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
        <div class="d-flex">
            @if (!$address->id == Auth::user()->shippingAddress()?->id)
                <form action="{{ route('account.addresses.update', ['address' => $address]) }}" method="post">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="is_shipping_address" value="1">
                    <button class="text-primary">Set as default address</button>
                </form>
            @endif
            <form action="" method="post">
                <button class="text-danger">Delete</button>
            </form>
        </div>
    </div>
</x-layouts.account>
