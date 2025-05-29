import threading
import requests
import time

# Danh sách URL cần gọi
URLS = [
    "https://khnguyen.store/cronjobs/gpt.php"
]

# Hàm gọi một URL (bỏ kiểm tra SSL)
def call_url(url):
    try:
        response = requests.get(url, timeout=5, verify=False)
        print(f"[{time.strftime('%H:%M:%S')}] {url} => {response.status_code}")
    except Exception as e:
        print(f"[{time.strftime('%H:%M:%S')}] {url} => ERROR: {e}")

# Vòng lặp chính chạy mỗi 1 giây
def run_cron():
    while True:
        threads = []
        for url in URLS:
            t = threading.Thread(target=call_url, args=(url,))
            t.start()
            threads.append(t)

        for t in threads:
            t.join()

        time.sleep(1)

if __name__ == "__main__":
    # Tắt warning SSL
    requests.packages.urllib3.disable_warnings()
    run_cron()
