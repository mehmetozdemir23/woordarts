<x-layouts.account>
    <div class="tab-pane fade {{ Route::current()->getName() == 'account.orders.index' ? 'active' : '' }}">
        <h4>Orders</h4>
        <div class="table_page table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>Order</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$order->created_at->format('Y-m-d')}}</td>
                        <td><span class="success">Completed</span></td>
                        <td>${{$order->order_total + $order->shippingMethod->shipping_method_price}}</td>
                        <td><a href="{{route('account.orders.show',['order'=>$order])}}" class="view">view</a></td>
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
        </div>
    </div>
</x-layouts.account>
