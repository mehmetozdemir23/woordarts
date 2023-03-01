<ul>
    @foreach($shipping_methods as $shipping_method)
        <li>
            <div class="custom-check">
                <input class="custom-check-input" type="radio" id="shipping_method_{{ $shipping_method->id }}"
                    name="shipping_method_id" value="{{ $shipping_method->id }}" {{ $loop->index === 0 ? 'checked' : '' }}>
                <label class="custom-check-label blue" for="shipping_method_{{ $shipping_method->id }}">
                    {{ $shipping_method->shipping_method_name }}
                </label>
                <span>${{ $shipping_method->shipping_method_price }}</span>
            </div>
        </li>
    @endforeach
</ul>
