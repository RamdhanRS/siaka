<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIKA - Sistem Informasi Akademik</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7f9;
            color: #333;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 5%;
            background-color: #2e5a88;
            color: white;
        }

        .navbar .logo {
            font-size: 1.5rem;
            font-weight: 700;
        }

        .navbar .nav-links a {
            color: white;
            text-decoration: none;
            margin-left: 2rem;
            font-weight: 400;
        }

        .hero {
            text-align: center;
            padding: 5rem 5%;
            background-color: white;
        }

        .hero h1 {
            font-size: 3rem;
            color: #2e5a88;
            margin-bottom: 0.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto 2rem auto;
        }

        .hero .cta-button {
            background-color: #2e5a88;
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s;
        }

        .hero .cta-button:hover {
            background-color: #3b71a2;
        }

        .features {
            padding: 4rem 5%;
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            color: #2e5a88;
            margin-bottom: 2rem;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }

        .feature-card {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .feature-card h3 {
            color: #2e5a88;
        }

        .footer {
            background-color: #2e5a88;
            color: white;
            text-align: center;
            padding: 2rem 5%;
        }
    </style>
</head>

<body>

    <header class="navbar">
        <div class="logo">SIKA</div>
        <nav class="nav-links">
            <a href="#">Beranda</a>
            <a href="#fitur">Fitur</a>
            <a href="#">Tentang Kami</a>
            <a href="#">Kontak</a>
            <a href="#" class="cta-login">Masuk</a>
        </nav>
    </header>

    <section class="hero">
        <h1>Kelola Perkuliahan Anda Lebih Mudah dengan SIKA</h1>
        <p>Sistem Informasi Akademik Terintegrasi untuk Dosen dan Mahasiswa.</p>
        <a href="#" class="cta-button">Mulai Sekarang</a>
    </section>

    <section id="fitur" class="features">
        <h2>Fitur Unggulan SIKA</h2>
        <div class="feature-grid">
            <div class="feature-card">
                <h3>Manajemen Dosen & Mahasiswa</h3>
                <p>Kelola data dosen dan mahasiswa dengan mudah. Tambah, edit, dan hapus data secara terpusat.</p>
            </div>
            <div class="feature-card">
                <h3>Manajemen Nilai</h3>
                <p>Input dan lihat nilai mahasiswa secara real-time. Terhubung langsung dengan pengisian KRS.</p>
            </div>
            <div class="feature-card">
                <h3>Pengisian KRS Online</h3>
                <p>Mahasiswa dapat mengisi Kartu Rencana Studi (KRS) secara mandiri dan diverifikasi.</p>
            </div>
            <div class="feature-card">
                <h3>Jadwal Interaktif</h3>
                <p>Akses jadwal perkuliahan, ruang, dan dosen pengampu dengan tampilan yang bersih.</p>
            </div>
        </div>
    </section>

    <footer class="footer">
        <p>&copy; <?php echo date("Y"); ?> SIKA. All Rights Reserved.</p>
    </footer>

</body>

</html>