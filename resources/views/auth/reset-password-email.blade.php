<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt lại mật khẩu</title>
    <style>
        /* Styles để hỗ trợ Bootstrap trong email */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #fff;
            background-color: #006aff;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            text-align: center;
        }
        .btn:hover {
            background-color: #138496;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h3 {
            color: #333;
        }
        p {
            color: #555;
            font-size: 16px;
            line-height: 1.5;
        }
        .footer {
            font-size: 14px;
            color: #888;
            margin-top: 20px;
            border-top: 1px solid #ddd;
            padding-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Xin chào, {{ $user->username }}</h3>
        
        <p>Bạn đã yêu cầu đặt lại mật khẩu cho tài khoản của mình trên hệ thống của chúng tôi. Để tiếp tục quá trình, vui lòng nhấp vào liên kết bên dưới:</p>
        
        <a href="{{ route('password.reset.custom', $token) }}" style="color: white" class="btn">Đặt lại mật khẩu</a>

        <p><strong>Lưu ý quan trọng:</strong> Liên kết này chỉ có hiệu lực trong vòng 24 giờ kể từ khi bạn nhận được email này. Nếu bạn không thực hiện thao tác này, vui lòng bỏ qua email này và mật khẩu của bạn sẽ không thay đổi.</p>

        <p>Để bảo vệ tài khoản của bạn, vui lòng không chia sẻ liên kết này với bất kỳ ai khác. Nếu bạn cần thêm hỗ trợ hoặc có bất kỳ câu hỏi nào, vui lòng liên hệ với chúng tôi qua email hỗ trợ hoặc gọi trực tiếp đến số hotline bên dưới.</p>

        <p>Trân trọng,<br>Đội ngũ Hỗ trợ Khách hàng</p>

        <div class="footer">
            <p>Đội ngũ hỗ trợ: support@gmail.com | Hotline: 1800-123-456</p>
            <p>&copy; {{ date('Y') }} Fruitables. Mọi quyền được bảo lưu.</p>
        </div>
    </div>
</body>
</html>
