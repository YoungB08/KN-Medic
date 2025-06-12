<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/functions/config.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/models/user.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/head.php'; ?>
<?php include $_SERVER['DOCUMENT_ROOT'] . '/includes/nav.php'; ?>
<?php if (UserModel::isLogin() == 0) return $KNCMS->msg_warning("Vui lòng đăng nhập", hUrl('Login'), 1000);
?>
<style>
    body {
        background: linear-gradient(to right, #1f1f1f, #2c2c2c);
        color: #fff;
        font-family: 'Segoe UI', sans-serif;
    }

    .form-card,
    .table-card {
        background: linear-gradient(145deg, #2a2a2a, #1e1e1e);
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 40px;
        box-shadow: 0 0 25px rgba(255, 50, 50, 0.1);
        border: 1px solid #333;
    }

    .form-label {
        color: #ccc;
    }

    .form-control {
        background-color: #2e2e2e;
        border: 1px solid #444;
        color: #fff;
    }

    .form-control:focus {
        border-color: #e53935;
        box-shadow: 0 0 0 0.2rem rgba(229, 57, 53, 0.3);
    }

    .btn-danger {
        background-color: #e53935;
        border: none;
    }

    .btn-danger:hover {
        background-color: #c62828;
    }

    h2,
    h4 {
        color: #fff;
    }

    table {
        color: #fff;
    }

    thead th {
        background-color: #2d2d2d;
        color: #e53935;
    }

    tbody tr {
        background-color: #2a2a2a;
        border-bottom: 1px solid #444;
    }

    .ticket-id {
        font-weight: bold;
        color: #f44336;
    }

    .table-card {
        background-color: transparent;
        background-color: #e53935;
        text-align: center;
    }

    /* Table full width, bo tròn */
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border-radius: 20px;
        overflow: hidden;
        /* để bo tròn bảng */
        box-shadow: 0 0 15px rgba(229, 57, 53, 0.4);
        color: #fff;
        background-color: #1a1a1a;
    }

    /* Đầu bảng nền đỏ, chữ trắng */
    thead th {
        background-color: #e53935;
        color: #fff;
        padding: 12px 15px;
        text-align: left;
        font-weight: 600;
    }

    /* Các ô thân bảng */
    tbody td {
        padding: 12px 15px;
        border-bottom: 1px solid #333;
    }

    /* Màu nền xen kẽ cho dòng */
    tbody tr:nth-child(odd) {
        background-color: #222;
    }

    tbody tr:nth-child(even) {
        background-color: #1a1a1a;
    }

    /* Khi hover dòng */
    tbody tr:hover {
        background-color: #e53935;
        color: #fff;
        cursor: pointer;
    }

    /* ticket-id màu đỏ nổi bật */
    .ticket-id {
        font-weight: bold;
        color: #f44336;
    }

    /* Đảm bảo bảng bo tròn cả 4 góc */
    thead tr:first-child th:first-child {
        border-top-left-radius: 20px;
    }

    thead tr:first-child th:last-child {
        border-top-right-radius: 20px;
    }

    tbody tr:last-child td:first-child {
        border-bottom-left-radius: 20px;
    }

    tbody tr:last-child td:last-child {
        border-bottom-right-radius: 20px;
    }
</style>

<div class="container py-5">
    <h2 class="text-center mb-4">
        <i class="fas fa-calendar-check"></i> Đặt Lịch Khám Bệnh
    </h2>

    <!-- Form Đặt Lịch -->
    <div class="form-card">
        <form>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-user"></i> Họ và tên</label>
                    <input type="text" class="form-control" placeholder="Nhập họ tên bệnh nhân" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-phone"></i> Số điện thoại</label>
                    <input type="tel" class="form-control" placeholder="Nhập số điện thoại" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label"><i class="fas fa-hospital-user"></i> Chuyên khoa</label>
                    <select class="form-control" required>
                        <option value="">-- Chọn chuyên khoa --</option>
                        <option>Nội tổng quát</option>
                        <option>Nhi khoa</option>
                        <option>Tim mạch</option>
                        <option>Da liễu</option>
                        <option>Xét nghiệm</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label"><i class="fas fa-calendar-alt"></i> Ngày khám</label>
                    <input type="date" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label"><i class="fas fa-clock"></i> Giờ khám</label>
                    <input type="time" class="form-control" required>
                </div>
                <div class="col-12">
                    <label class="form-label"><i class="fas fa-notes-medical"></i> Ghi chú</label>
                    <textarea class="form-control" rows="2" placeholder="Triệu chứng, lưu ý... (không bắt buộc)"></textarea>
                </div>
                <div class="col-12 text-end">
                    <button type="submit" class="btn btn-danger px-4 mt-3"><i class="fas fa-paper-plane"></i> Gửi Yêu Cầu</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Danh sách lịch khám -->
    <div class="table-card">
        <h4 class="mb-3"><i class="fas fa-list"></i> Danh sách lịch khám</h4>
        <div class="table-responsive">
            <table class="table table-hover table-bordered align-middle">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bệnh nhân</th>
                        <th>Số điện thoại</th>
                        <th>Chuyên khoa</th>
                        <th>Ngày</th>
                        <th>Giờ</th>
                        <th>Ghi chú</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="ticket-id">#001</td>
                        <td>Nguyễn Văn A</td>
                        <td>0901234567</td>
                        <td>Nhi khoa</td>
                        <td>2025-06-01</td>
                        <td>09:00</td>
                        <td>Ho, sốt nhẹ</td>
                    </tr>
                    <tr>
                        <td class="ticket-id">#002</td>
                        <td>Trần Thị B</td>
                        <td>0912345678</td>
                        <td>Da liễu</td>
                        <td>2025-06-03</td>
                        <td>14:30</td>
                        <td>Mẩn đỏ vùng mặt</td>
                    </tr>
                    <!-- Có thể thêm nhiều dòng nữa bằng PHP -->
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?php

include $_SERVER['DOCUMENT_ROOT'] . '/includes/footer.php'; ?>

</html>