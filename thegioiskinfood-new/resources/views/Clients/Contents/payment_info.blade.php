<div>
    @if ($payment_method === 'bank')
    <!-- Thông tin thanh toán qua ngân hàng -->
    <h3>Thông tin chuyển khoản ngân hàng</h3>
    <p>- Ngân Hàng CPTM VietComBank</p>
    <p>- Số Tài Khoản: 1028329185</p>
    <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
    <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
    <p>Sau khi hoàn tất chuyển khoản, shop sẽ tự động hoàn tất đơn hàng cho bạn. Lưu ý nếu không hoàn tất đơn hàng sẽ tự
        động hủy</p>
    @elseif ($payment_method === 'momo')
    <!-- Thông tin thanh toán qua ví MoMo -->
    <h3>Thông tin chuyển khoản qua MoMo</h3>
    <p>- Ví MoMo</p>
    <p>- Số Tài Khoản: 0832575905</p>
    <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
    <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
    <p>Sau khi hoàn tất chuyển khoản, shop sẽ tự động hoàn tất đơn hàng cho bạn. Lưu ý nếu không hoàn tất đơn hàng sẽ tự
        động hủy</p>
    <!-- Thêm các phương thức thanh toán khác tương tự ở đây -->
    @elseif ($requestData['payment_methods'] === 'vnpay') {
    // Tạo thông tin chuyển khoản qua VNPay
    return "<h3>Thông tin chuyển khoản qua VNPay</h3>
    <p>- VNPay</p>
    <p>- Số Tài Khoản: 0832575905</p>
    <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
    <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
    <p>Sau khi hoàn tất chuyển khoản, shop sẽ tự động hoàn tất đơn hàng cho bạn. Lưu ý nếu không hoàn tất đơn hàng sẽ tự
        động hủy</p>";
    }@elseif ($requestData['payment_methods'] === 'shoppee') {
    // Tạo thông tin chuyển khoản qua Shoppe Pay
    return "<h3>Thông tin chuyển khoản qua Shoppe Pay</h3>
    <p>- Shoppe Pay</p>
    <p>- Số Tài Khoản: 0832575905</p>
    <p>- Tên Chủ Tài Khoản: Mai Lê Quel</p>
    <p>- Nội Dung Chuyển Khoản: Tên + SDT Đặt Hàng + Mã Đơn Hàng</p>
    <p>Sau khi hoàn tất chuyển khoản, shop sẽ tự động hoàn tất đơn hàng cho bạn. Lưu ý nếu không hoàn tất đơn hàng sẽ tự
        động hủy</p>";
    }
    @endif
</div>