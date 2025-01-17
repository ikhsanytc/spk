module.exports = {
  proxy: "http://localhost:8080", // Ganti dengan URL local development kamu
  files: ["app/**/*.php", "public/**/*.css", "public/**/*.js"], // Path file yang diawasi
  reloadDelay: 500, // Waktu delay reload
  open: true, // Buka browser secara otomatis
  notify: true, // Menampilkan notifikasi di browser
};
