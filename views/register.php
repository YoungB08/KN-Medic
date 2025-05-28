<!DOCTYPE html>
<html lang="en" data-id="td2xrtak" data-line="1-452">

<head data-id="euldupr9" data-line="1-120">
    <meta charset="UTF-8" data-id="2p7b7u2n" data-line="2-2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" data-id="lk18j27q" data-line="3-3">
    <title data-id="phrwl57o" data-line="4-4">Red Pill Auth UI</title>
    <script src="https://cdn.tailwindcss.com" data-id="4p3zlrgw" data-line="5-5"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        data-id="nqoa5dx5" data-line="6-6">
    <script data-id="xcrph70k" data-line="7-34">
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        primary: {
                            50: '#FEF2F2',
                            100: '#FEE2E2',
                            200: '#FECACA',
                            300: '#FCA5A5',
                            400: '#F87171',
                            500: '#EF4444',
                            600: '#DC2626',
                            700: '#B91C1C',
                            800: '#991B1B',
                            900: '#7F1D1D',
                        }
                    },
                    borderRadius: {
                        'pill': '9999px'
                    }
                }
            }
        }
    </script>
    <style data-id="h7kui7qh" data-line="35-119">
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 1rem;
        }

        .form-container {
            backdrop-filter: blur(5px);
            transition: all 0.4s ease;
            background-color: rgba(255, 255, 255, 0.85);
        }

        .input-field {
            transition: all 0.3s ease;
            border-radius: 9999px;
        }

        .input-field:focus {
            box-shadow: 0 0 0 2px rgba(239, 68, 68, 0.5);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #EF4444 0%, #F87171 100%);
            transition: all 0.3s ease;
            border-radius: 9999px;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, #DC2626 0%, #EF4444 100%);
        }

        .form-toggle {
            transition: all 0.3s ease;
        }

        .form-toggle:hover {
            text-decoration: underline;
        }

        .form-content {
            transition: opacity 0.4s ease, transform 0.4s ease;
        }

        .login-form {
            opacity: 1;
            transform: translateX(0);
        }

        .register-form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: white;
            opacity: 0;
            pointer-events: none;
            transition: all 0.3s ease;
            padding: 50px 30px;
            box-sizing: border-box;
            border-radius: 0 10px 10px 0;
            transform: translateX(-50px);
        }


        .active .login-form {
            opacity: 0;
            transform: translateX(-50px);
        }

        .active .register-form {
            opacity: 1;
            transform: translateX(0);
        }

        .error-message {
            transition: all 0.3s ease;
        }

        .input-icon {
            color: #EF4444;
        }
    </style>
</head>

<body data-id="mga89kiz" data-line="121-452">
    <div class="form-card relative w-full max-w-md" data-id="19co7fhv" data-line="122-294">
        <div class="form-content login-form form-container rounded-[50px] shadow-xl p-8" data-id="s10ysaao"
            data-line="123-200">
            <div class="flex justify-center mb-8" data-id="1xuknhp2" data-line="124-128">
                <div class="w-50 h-50 rounded-full shadow-md flex items-center justify-center"
                    data-id="x6dm2z0z" data-line="125-127">
                    <img src="../assets/logo.png" style="width: 100%; height: 100%;" />
                </div>
            </div>

            <h2 class="text-2xl font-bold text-center text-gray-800 mb-8" data-id="e1xp7j8r" data-line="130-130">Chào mừng bạn đến với <br><b>KN-Medic</b></h2>

            <form class="space-y-6" id="login-form" method="post">
                <div data-id="7xq1j5ob" data-line="133-142">
                    <label for="login-email" class="block text-sm font-medium text-gray-700 mb-1" data-id="tkl4wmrd"
                        data-line="134-134">Username</label>
                    <div class="relative" data-id="817daxjg" data-line="135-140">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            data-id="f05o9jnr" data-line="136-138">
                            <i class="fas fa-user input-icon" data-id="p6c8sqx1" data-line="137-137"></i>
                        </div>
                        <input id="login-email" type="text"
                            class="input-field pl-10 w-full px-4 py-3 border border-gray-300 focus:outline-none"
                            placeholder="Enter your username" required="" data-id="6nnj3neo"
                            data-line="139-139">
                    </div>
                    <p class="error-message text-red-600 text-xs mt-1 hidden" data-id="nfe5gh0e" data-line="141-141">
                        Please enter a valid username</p>
                </div>
                <div data-id="7xq1j5ob" data-line="133-142">
                    <label for="login-name" class="block text-sm font-medium text-gray-700 mb-1" data-id="tkl4wmrd"
                        data-line="134-134">Full name</label>
                    <div class="relative" data-id="817daxjg" data-line="135-140">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            data-id="f05o9jnr" data-line="136-138">
                            <i class="fas fa-user input-icon" data-id="p6c8sqx1" data-line="137-137"></i>
                        </div>
                        <input id="login-name" type="text"
                            class="input-field pl-10 w-full px-4 py-3 border border-gray-300 focus:outline-none"
                            placeholder="Enter your full name" required="" data-id="6nnj3neo"
                            data-line="139-139">
                    </div>
                    <p class="error-message text-red-600 text-xs mt-1 hidden" data-id="nfe5gh0e" data-line="141-141">
                        Please enter a valid username</p>
                </div>

                <div data-id="sok2kj8z" data-line="144-156">
                    <label for="login-password" class="block text-sm font-medium text-gray-700 mb-1" data-id="9vupslng"
                        data-line="145-145">Password</label>
                    <div class="relative" data-id="rzgr3kfx" data-line="146-154">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            data-id="l4hluhgg" data-line="147-149">
                            <i class="fas fa-lock input-icon" data-id="3iyouc5c" data-line="148-148"></i>
                        </div>
                        <input id="login-password" type="password"
                            class="input-field pl-10 w-full px-4 py-3 border border-gray-300 focus:outline-none"
                            placeholder="Enter your password" required="" data-id="8ro3d0bu" data-line="150-150">
                        <button type="button" class="absolute inset-y-0 right-0 pr-3 flex items-center"
                            data-id="lirt1zx0" data-line="151-153">
                            <i class="fas fa-eye input-icon hover:text-red-500 cursor-pointer" data-id="20doqd2d"
                                data-line="152-152"></i>
                        </button>
                    </div>
                    <p class="error-message text-red-600 text-xs mt-1 hidden" data-id="qzgy9as3" data-line="155-155">
                        Password must contain at least 8 characters</p>
                </div>
                <div data-id="7xq1j5ob" data-line="133-142">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1" data-id="tkl4wmrd"
                        data-line="134-134">Email</label>
                    <div class="relative" data-id="817daxjg" data-line="135-140">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"
                            data-id="f05o9jnr" data-line="136-138">
                            <i class="fa-solid fa-envelope input-icon hover:text-red-500 cursor-pointer"></i>
                        </div>
                        <input id="email" type="email"
                            class="input-field pl-10 w-full px-4 py-3 border border-gray-300 focus:outline-none"
                            placeholder="Enter your email" required="" data-id="6nnj3neo"
                            data-line="139-139">
                    </div>
                    <p class="error-message text-red-600 text-xs mt-1 hidden" data-id="nfe5gh0e" data-line="141-141">
                        Please enter a valid email</p>
                </div>
                <div data-id="phone-block" data-line="143-152">
                    <label for="login-phone" class="block text-sm font-medium text-gray-700 mb-1">Số điện thoại</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fa-solid fa-phone input-icon hover:text-green-500 cursor-pointer"></i>
                        </div>
                        <input id="login-phone" type="tel"
                            class="input-field pl-10 w-full px-4 py-3 border border-gray-300 focus:outline-none"
                            placeholder="09..." required pattern="^\+84\d{9,10}$">
                    </div>
                    <p class="error-message text-red-600 text-xs mt-1 hidden">
                        Please enter a valid phone number
                    </p>
                </div>


                <button id="login-submit" type="submit" class="btn-gradient w-full py-3 px-4 text-white font-semibold shadow-md"
                    data-id="2ip6j6on" data-line="166-168">
                    Sign In
                </button>
            </form>

            <div class="mt-6 text-center" data-id="h1akgsqk" data-line="171-176">
                <p class="text-sm text-gray-600" data-id="06lq4uwf" data-line="172-175">
                    Don't have an account?
                    <a class="form-toggle text-red-500 font-medium" href="">Sign Up</a>
                </p>
            </div>
        </div>
    </div>
    <script>
        $('#login-form').on('submit', function(e) {
            e.preventDefault(); // Ngăn form reload trang

            const submitBtn = $('#login-submit');
            submitBtn.prop('disabled', true).text('Đang xử lý...');

            $.ajax({
                url: 'API/Register', // đường dẫn controller PHP
                method: 'POST',
                dataType: 'json',
                data: {
                    username: $('#login-email').val(),
                    password: $('#login-password').val(),
                    email: $('#email').val(),
                    phone: $('#login-phone').val(),
                    name: $('#login-name').val()
                },
                success: function(response) {
                    console.log(response);
                    // Xử lý phản hồi từ PHP
                    if (response.status == 1) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        }).then(() => {
                            window.location.href = 'Home';
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: response.msg,
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi kết nối',
                        text: 'Không thể kết nối đến máy chủ!',
                        confirmButtonText: 'Đóng'
                    });
                    console.error(xhr.responseText);
                },
                complete: function() {
                    // Enable lại nút khi xong (dù success hay error)
                    submitBtn.prop('disabled', false).text('Sign In');
                }
            });
        });
    </script>


    <script data-id="hjzavewz" data-line="296-449">
        document.addEventListener('DOMContentLoaded', function() {
            formCard = document.querySelector('.form-card');
            toggleButtons = document.querySelectorAll('.form-toggle');
            passwordFields = document.querySelectorAll('input[type="password"]');
            passwordToggles = document.querySelectorAll('input[type="password"] + button');

            // Toggle between login and register forms
            toggleButtons.forEach(button => {
                button.addEventListener('click', () => {
                    formCard.classList.toggle('active');
                });
            });

            // Toggle password visibility
            passwordToggles.forEach((toggle, index) => {
                toggle.addEventListener('click', () => {
                    passwordField = passwordFields[index];
                    icon = toggle.querySelector('i');

                    if (passwordField.type === 'password') {
                        passwordField.type = 'text';
                        icon.classList.replace('fa-eye', 'fa-eye-slash');
                    } else {
                        passwordField.type = 'password';
                        icon.classList.replace('fa-eye-slash', 'fa-eye');
                    }
                });
            });


        });
    </script>



</body>

</html>