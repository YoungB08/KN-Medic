<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nạp Coins TikTok</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        :root {
            --black: #0f0f0f;
            --pink: #fe2c55;
            --blue: #25f4ee;
            --white: #ffffff;
            --gradient: linear-gradient(135deg, #25f4ee, #fe2c55, #a100ff);
            --glass-bg: rgba(255, 255, 255, 0.06);
        }

        body {
            background-color: var(--black);
            color: var(--white);
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background-color: var(--black);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .nav-link {
            color: var(--white) !important;
        }

        .package-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 1.5rem;
            margin-top: 2rem;
        }

        .card-package {
            background: var(--glass-bg);
            border-radius: 20px;
            padding: 1.2rem;
            backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            text-align: center;
        }

        .card-package::before {
            content: "";
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: var(--gradient);
            animation: rotate 6s linear infinite;
            z-index: 0;
            filter: blur(50px);
            opacity: 0.3;
        }

        .card-package:hover {
            transform: scale(1.05);
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
        }

        .card-package.active {
            box-shadow: 0 0 30px #25f4ee;
            border: 2px solid #25f4ee;
        }

        .card-package .content {
            position: relative;
            z-index: 1;
        }

        .btn-pay {
            margin-top: 30px;
            background: var(--gradient);
            border: none;
            color: white;
            padding: 12px 25px;
            border-radius: 10px;
            font-weight: bold;
            transition: background 0.3s ease;
        }

        .btn-pay:hover {
            background: linear-gradient(135deg, #fe2c55, #25f4ee);
        }

        #qrModal .modal-content {
            background-color: #121212;
            color: white;
            border: 1px solid #333;
            border-radius: 15px;
        }

        #qrModal img {
            max-width: 100%;
            border-radius: 12px;
        }

        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        h1 {
            background: var(--gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            text-align: center;
            margin-top: 2rem;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg px-4">
        <a class="navbar-brand text-white" href="#">
            <i class="fab fa-tiktok me-2"></i> TikTok Coins
        </a>
    </nav>

    <div class="container">
        <h1>Chọn Gói Nạp</h1>
        <div class="package-grid" id="packageGrid">
            <!-- Gói sẽ được generate bằng JS -->
        </div>
        <div class="text-center">
            <button class="btn-pay" onclick="proceedToPay()">Thanh toán</button>
        </div>
    </div>

    <!-- Modal QR -->
    <div id="qr-area"></div>
    <div class="modal fade" id="qrModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered text-center">
            <div class="modal-content p-4">
                <h5>Quét QR để thanh toán</h5>
                <div id="qrImageContainer" class="my-3">
                    <img src="" id="qrImage" alt="QR Code" />
                </div>
                <p>Sử dụng app ngân hàng để quét và hoàn tất giao dịch.</p>
            </div>
        </div>
    </div>

    <!-- Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const packages = [{
                coins: 70,
                price: 20000
            },
            {
                coins: 350,
                price: 100000
            },
            {
                coins: 700,
                price: 200000
            },
            {
                coins: 1400,
                price: 400000
            },
            {
                coins: 3500,
                price: 1000000
            },
        ];

        let selectedPackage = null;

        const grid = document.getElementById("packageGrid");

        // Tạo các gói
        packages.forEach((pkg, index) => {
            const card = document.createElement("div");
            card.className = "card-package";
            card.innerHTML = `
        <div class="content">
          <h5>${pkg.coins} Coins</h5>
          <p>Giá: ${pkg.price.toLocaleString()}đ</p>
        </div>
      `;
            card.onclick = () => {
                document.querySelectorAll(".card-package").forEach(c => c.classList.remove("active"));
                card.classList.add("active");
                selectedPackage = pkg;
            };
            grid.appendChild(card);
        });

        function proceedToPay() {
            if (!selectedPackage) {
                alert("Vui lòng chọn một gói trước khi thanh toán.");
                return;
            }

            function showQR(coins, price) {
                // Chuẩn bị nội dung chuyển khoản (không dấu, tránh lỗi)
                const desc = `Nap TikTok ${coins} coins`;
                const encodedDesc = encodeURIComponent(desc);

                // Gọi tới PHP
                console.log(price);
                console.log(coins);
                fetch(`ajax/bank.php?amount=${price}&noidung=${encodedDesc}`)
                    .then(response => response.text())
                    .then(html => {
                        document.getElementById("qr-area").innerHTML = html;
                    })
                    .catch(err => {
                        console.error("Lỗi:", err);
                    });
            }

            // Ví dụ gọi (100 coins, giá 50000đ)
            showQR(selectedPackage.coins, selectedPackage.price);


        }
    </script>
</body>

</html>