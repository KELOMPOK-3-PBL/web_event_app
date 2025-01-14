# Panduan Setup Website Polivent Management
- Pastikan sudah menginstal composer, penyedia server local (XAMPP atau laragon), dan git
- Buka Terminal atau Command Prompt
- Arahkan ke direktori localhost dan buat direktori pbl /htdocs/pbl untuk XAMPP dan /www/pbl untuk laragon
- Jalankan command "git clone https://github.com/KELOMPOK-3-PBL/web_event_app.git"
- Jalankan command "git clone https://github.com/KELOMPOK-3-PBL/api-03.git"
- Masuk ke direktori api-03 jalankan command "composer install"
- Buka browser dan arahkan ke halaman http://localhost/pbl
- Buka phpmyadmin, buat database testpbl dan import file test_event_proposal.sql di direktori api-03
- Untuk user superadmin
	> email : superadmin@gmail.com
	> password : 123456 
- Untuk user propose
	> email : member_propose@gmail.com
	> password : 123456 