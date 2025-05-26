<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/server/config.php'); ?>

<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/private/head.php'); ?>
<?php require_once($_SERVER['DOCUMENT_ROOT'] . '/private/nav.php'); ?>

<head data-id="681144qm" data-line="1-28">
  <meta charset="UTF-8" data-id="csl2zt7f" data-line="2-2">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" data-id="289wmvee" data-line="3-3">
  <script src="https://cdn.tailwindcss.com" data-id="jw8rq0k8" data-line="4-4"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" data-id="c2ybya7m" data-line="5-5">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&amp;display=swap" rel="stylesheet" data-id="3v5prjy3" data-line="6-6">
  <style data-id="3w4c2dog" data-line="8-27">
    @keyframes pulse-glow {
      0% {
        box-shadow: 0 0 10px rgba(124, 58, 237, 0.5);
      }

      50% {
        box-shadow: 0 0 30px rgba(124, 58, 237, 0.9);
      }

      100% {
        box-shadow: 0 0 10px rgba(124, 58, 237, 0.5);
      }
    }

    @keyframes float {
      0% {
        transform: translateY(0px);
      }

      50% {
        transform: translateY(-10px);
      }

      100% {
        transform: translateY(0px);
      }
    }

    .rarity-common {
      border-color: #6b7280;
    }

    .rarity-rare {
      border-color: #3b82f6;
    }

    .rarity-epic {
      border-color: #a855f7;
    }

    .rarity-legendary {
      border-color: #f59e0b;
    }

    .glow-common {
      box-shadow: 0 0 10px rgba(107, 114, 128, 0.5);
    }

    .glow-rare {
      box-shadow: 0 0 15px rgba(59, 130, 246, 0.7);
    }

    .glow-epic {
      box-shadow: 0 0 20px rgba(168, 85, 247, 0.9);
    }

    .glow-legendary {
      box-shadow: 0 0 25px rgba(245, 158, 11, 0.9);
    }
  </style>
</head>
<div class="container mx-auto px-4 py-8 min-h-screen" data-id="kscwuvnw" data-line="30-152">
  <div class="flex flex-col md:flex-row gap-8" data-id="3fpvedvj" data-line="52-89">
    <div class="flex-1 flex flex-col items-center" data-id="erijfixc" data-line="54-74">
      <div class="relative w-full max-w-md mb-6" data-id="sz2f8a05" data-line="55-73">
        <div class="absolute inset-0 bg-purple-500 rounded-2xl opacity-20 blur-xl" data-id="1fic0zsd" data-line="56-56"></div>
        <div class="relative bg-gray-800 bg-opacity-70 rounded-2xl p-8 backdrop-blur-sm" data-id="tzv7hhgx" data-line="57-72">
          <div class="flex justify-center mb-8" data-id="v36ur5k7" data-line="58-66">
            <div class="w-64 h-64 rounded-full bg-gradient-to-br from-purple-900 to-gray-900 border-4 border-purple-500 flex items-center justify-center relative overflow-hidden" data-id="c8ln43dn" data-line="59-65">
              <div class="absolute inset-0 bg-purple-500 opacity-10 animate-pulse" data-id="aud3ymkk" data-line="60-60"></div>
              <div class="relative z-10 text-center p-4" data-id="1rukxffe" data-line="61-64">
                <i class="fas fa-question text-6xl text-purple-300 mb-2" data-id="cvntysd9" data-line="62-62"></i>
                <p class="text-purple-200 text-sm" data-id="yu9xc3it" data-line="63-63">Nhấn để quay</p>
              </div>
            </div>
          </div>

          <button id="gacha-btn" class="w-full py-4 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-bold rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-purple-500 focus:ring-opacity-50 animate-pulse-glow" style="animation: pulse-glow 2s infinite;" data-id="2p4e45sp" data-line="68-71">
            QUAY NGAY (1 LẦN)
            <i class="fas fa-gem ml-2" data-id="y31stxlh" data-line="70-70"></i>
          </button>
        </div>
      </div>
    </div>

    <!-- Item Reveal Panel -->
    <div class="flex-1" data-id="qgpa2c4o" data-line="77-88">
      <div class="bg-gray-800 bg-opacity-70 rounded-2xl p-6 backdrop-blur-sm h-full" data-id="f6tvjkij" data-line="78-87">
        <h2 class="text-xl font-bold text-white mb-6" data-id="pmqjvdqt" data-line="79-79">Vật phẩm vừa nhận</h2>

        <div id="result-panel" class="flex justify-center items-center min-h-64" data-id="7ezy2djr" data-line="81-86">
          <div class="text-center text-gray-400" data-id="b2bbl52f" data-line="82-85">
            <i class="fas fa-box-open text-4xl mb-2" data-id="0ungi1p5" data-line="83-83"></i>
            <p data-id="2hkpejrd" data-line="84-84">Chưa có vật phẩm nào</p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Item List -->
  <div class="mt-12" data-id="sx6f3906" data-line="92-151">
    <div class="bg-gray-800 bg-opacity-70 rounded-2xl p-6 backdrop-blur-sm" data-id="qemfmtpb" data-line="93-150">
      <h2 class="text-xl font-bold text-white mb-6" data-id="maueitdz" data-line="94-94">Danh sách vật phẩm</h2>

      <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-4" data-id="hjvfwar2" data-line="96-149">
        <!-- Common Item -->
        <?php
        echoGachaItem("Bravura", 1, "http://localhost/lib/model/vehicles/Vehicle_401.jpg");

        ?>
      </div>
    </div>
  </div>
</div>

<!-- Notification Toast -->
<div id="toast" class="fixed bottom-4 right-4 bg-green-600 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-16 opacity-0 transition-all duration-300 hidden" data-id="je1qqbzd" data-line="155-160">
  <div class="flex items-center" data-id="n121eknx" data-line="156-159">
    <i class="fas fa-check-circle mr-2" data-id="m3he4fpm" data-line="157-157"></i>
    <span id="toast-message" data-id="3da948cr" data-line="158-158">Đã nhận vật phẩm mới!</span>
  </div>
</div>

<script data-id="ymynf1gm" data-line="162-221">
  document.getElementById('gacha-btn').addEventListener('click', function() {
    // Simulate gacha pull
    const btn = this;
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> ĐANG QUAY...';

    // Show loading animation
    const resultPanel = document.getElementById('result-panel');
    resultPanel.innerHTML = `
        <div class="animate-pulse text-center">
          <i class="fas fa-spinner fa-spin text-4xl text-purple-400 mb-2"></i>
          <p class="text-purple-200">Đang quay vật phẩm...</p>
        </div>
      `;

    // Simulate server delay
    setTimeout(() => {
      // Random result
      const items = [{
          name: 'Khiên Thường',
          icon: 'fa-shield-alt',
          rarity: 'common',
          color: 'gray'
        },
        {
          name: 'Ngọc Quý',
          icon: 'fa-gem',
          rarity: 'rare',
          color: 'blue'
        },
        {
          name: 'Gậy Phép',
          icon: 'fa-magic',
          rarity: 'epic',
          color: 'purple'
        },
        {
          name: 'Vương Miện',
          icon: 'fa-crown',
          rarity: 'legendary',
          color: 'amber'
        }
      ];
      const rarities = ['common', 'common', 'common', 'rare', 'rare', 'epic', 'legendary'];
      const rarity = rarities[Math.floor(Math.random() * rarities.length)];
      const filteredItems = items.filter(item => item.rarity === rarity);
      const result = filteredItems[Math.floor(Math.random() * filteredItems.length)];

      // Show result
      resultPanel.innerHTML = `
          <div class="text-center animate__animated animate__fadeIn">
            <div class="inline-block bg-${result.color}-600 rounded-xl p-4 border-4 border-${result.color}-400 glow-${rarity} transform transition-all duration-500 animate-float" style="animation: float 3s infinite;">
              <i class="fas ${result.icon} text-6xl text-white"></i>
            </div>
            <h3 class="text-2xl font-bold text-white mt-4">${result.name}</h3>
            <p class="text-${result.color}-300 uppercase font-medium">${rarity}</p>
          </div>
        `;

      // Show toast notification
      const toast = document.getElementById('toast');
      document.getElementById('toast-message').textContent = `Đã nhận ${result.name} (${rarity})!`;
      toast.classList.remove('hidden');
      toast.classList.add('translate-y-0', 'opacity-100');

      setTimeout(() => {
        toast.classList.remove('translate-y-0', 'opacity-100');
        toast.classList.add('translate-y-16', 'opacity-0');
      }, 3000);

      // Reset button
      setTimeout(() => {
        btn.disabled = false;
        btn.innerHTML = 'QUAY NGAY (1 LẦN) <i class="fas fa-gem ml-2"></i>';
      }, 1000);
    }, 1500);
  });
</script>

</body>

</html>