@extends('client.index')

@section('content')
    @php
        $tongdon = 0;
    @endphp
    <div class="container mt-5">
        <h2 class="mb-4">Shopping Cart</h2>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr class="text-center table-success">
                    <th scope="col">STT</th>
                    <th scope="col">Product Image</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Total</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($listCart as $index => $item)
                    <tr id="cart-{{ $item->id }}" class="text-center cart-item" data-id="{{ $item->id }}">
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ Storage::url($item->product->image) }}" width="100" alt="Product Image"
                                class="img-fluid"></td>
                        <td>{{ $item->product->name }}</td>
                        <td data-price="{{ $item->product->price }}" class="item-price">
                            {{ number_format($item->product->price) }} vnđ</td>
                        <td>
                            <div class="input-group d-inline-flex justify-content-center" style="width: 100px;">
                                <button class="btn btn-sm btn-outline-secondary btn-minus" type="button"
                                    onclick="updateCartQuantity({{ $item->id }}, parseInt(this.nextElementSibling.value) - 1)">-</button>
                                <input class="quantity form-control text-center border-0" type="text"
                                    value="{{ $item->quantity }}" min="1"
                                    onchange="updateCartQuantity({{ $item->id }}, this.value)">
                                <button class="btn btn-sm btn-outline-secondary btn-plus" type="button"
                                    onclick="updateCartQuantity({{ $item->id }}, parseInt(this.previousElementSibling.value) + 1)">+</button>
                            </div>
                        </td>
                        <td class="item-total">{{ number_format($item->product->price * $item->quantity) }} vnđ</td>
                        <td>
                            <button type="button" onclick="deleteCart({{ $item->id }})" class="btn btn-danger"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @php
                        $tongdon += $item->product->price * $item->quantity;
                    @endphp
                @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end">
            <h4>Total: <span id="cart-total">{{ number_format($tongdon) }} vnđ</span></h4>
        </div>
        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary">Checkout</button>
        </div>
    </div>
@endsection
@section('javascript')
    <script type="text/javascript">
        // Hàm cập nhật số lượng sản phẩm trong giỏ hàng
        function updateCartQuantity(cartItemId, quantity) {
            // Kiểm tra xem số lượng có nhỏ hơn 1 không
            if (quantity < 1) {
                toastr.error('Số lượng không thể nhỏ hơn 1 !'); // Hiển thị cảnh báo
                return; // Dừng thực hiện hàm nếu số lượng không hợp lệ
            }

            // Gửi yêu cầu AJAX để cập nhật số lượng
            $.ajax({
                url: '{{ route('client.cart.updateQuantity') }}',
                type: 'POST', // Phương thức yêu cầu là POST
                data: {
                    cart_item_id: cartItemId, // ID của mục giỏ hàng
                    quantity: quantity, // Số lượng mới
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token để bảo vệ yêu cầu
                },
                success: function(response) {
                    // Xử lý khi yêu cầu thành công
                    if (response.success) {
                        // Tìm dòng tương ứng với mục giỏ hàng trong bảng
                        const row = $('.cart-item[data-id="' + cartItemId + '"]');
                        row.find('.quantity').val(quantity); // Cập nhật ô input số lượng
                        // Lấy giá sản phẩm từ thuộc tính data của phần tử
                        const price = parseFloat(row.find('.item-price').data('price'));
                        // Tính tổng giá cho mục giỏ hàng
                        const total = price * quantity;
                        // Cập nhật tổng giá trong giao diện
                        row.find('.item-total').text(number_format(total) + ' vnđ');
                        // Cập nhật tổng cho toàn bộ giỏ hàng
                        updateCartTotal();
                        toastr.success('Cập nhập thành công !');
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error("Đã có lỗi xảy ra. Vui lòng thử lại!"); // Hiển thị thông báo lỗi
                }
            });
        }


        // Hàm tính toán tổng giỏ hàng
        function updateCartTotal() {
            let total = 0; // Khởi tạo tổng giá trị giỏ hàng bằng 0
            // Lặp qua từng mục trong giỏ hàng
            $('.cart-item').each(function() {
                // Lấy tổng giá của từng mục và chuyển đổi thành số
                const itemTotal = parseFloat($(this).find('.item-total').text().replace(' vnđ', '').replace(/,/g,
                    ''));
                total += itemTotal; // Cộng dồn vào tổng
            });
            // Cập nhật tổng giỏ hàng trong giao diện
            $('#cart-total').text(number_format(total) + ' vnđ'); // Hiển thị tổng
        }

        // Hàm định dạng số để hiển thị theo kiểu tiền tệ
        function number_format(number) {
            return number.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ","); // Định dạng số với dấu phẩy
        }

        function deleteCart(cartItemId) {
            let quantityCart = document.getElementById('cartTotal').innerText
            $.ajax({
                url: '{{ route('client.cart.destroy', '') }}/' + cartItemId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    $('#cart-' + cartItemId).remove();
                    updateCartTotal();
                    $('#cartTotal').text(quantityCart-1 ); // Hiển thị tổng
                    toastr.success('Xóa thành công !');
                },
                error: function(xhr) {
                    toastr.error('Đã xảy ra lỗi khi xóa sản phẩm.');
                }
            });
        }

        
    </script>
@endsection
