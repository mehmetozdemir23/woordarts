<x-layouts.account>
    <div class="tab-pane fade {{ Route::current()->getName() == 'account.orders.show' ? 'active' : '' }}">
        <h4>Order n° {{ $order->id }}</h4>
        <div class="table_page table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderLines as $order_line)
                        <tr>
                            <td>{{ $order_line->productItem->product->product_name }}</td>
                            <td>{{ $order_line->order_line_quantity }}</td>
                            <td>${{ $order_line->order_line_price }}</td>
                        </tr>
                    @endforeach
                    {{-- <tr>
                        <td>1</td>
                        <td>May 10, 2018</td>
                        <td><span class="success">Completed</span></td>
                        <td>$25.00 for 1 item </td>
                        <td><a href="cart.html" class="view">view</a></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>May 10, 2018</td>
                        <td>Processing</td>
                        <td>$17.00 for 1 item </td>
                        <td><a href="cart.html" class="view">view</a></td>
                    </tr> --}}
                </tbody>
            </table>
            <a href="{{ url()->previous() }}" class="link-dark border-1 border-dark border-bottom">
                &#8592; Back</a>
        </div>
    </div>
</x-layouts.account>
