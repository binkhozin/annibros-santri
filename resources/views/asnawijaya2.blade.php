<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD Asnawi Jaya 2 - Toko Bangunan Terpercaya</title>
    @vite(['resources/css/app.css'])
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #f1f5f9;
            overflow-x: hidden;
        }

        .bg-glow {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle at 20% 30%, rgba(16, 185, 129, 0.12) 0%, transparent 40%),
                        radial-gradient(circle at 80% 70%, rgba(6, 182, 212, 0.12) 0%, transparent 40%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(12px) saturate(180%);
            -webkit-backdrop-filter: blur(12px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            transition: all 0.3s ease;
        }

        .glass-card:hover {
            background: rgba(255, 255, 255, 0.06);
            border-color: rgba(16, 185, 129, 0.3);
            transform: translateY(-5px);
        }

        .glass-nav {
            background: rgba(15, 23, 42, 0.7);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .text-gradient {
            background: linear-gradient(to right, #6ee7b7, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .btn-glass {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .btn-glass:hover {
            background: rgba(16, 185, 129, 0.2);
            border-color: rgba(16, 185, 129, 0.5);
            box-shadow: 0 0 20px rgba(16, 185, 129, 0.2);
        }

        .product-img {
            filter: grayscale(20%) contrast(110%);
            transition: all 0.5s ease;
        }

        .glass-card:hover .product-img {
            filter: grayscale(0%) contrast(100%);
            scale: 1.05;
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <!-- Navigation -->
    <nav class="glass-nav fixed top-0 w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-extrabold tracking-tighter">
                <span class="text-emerald-400">UD Asnawi</span><span class="text-slate-400">Jaya 2</span>
            </div>
            <div class="hidden md:flex space-x-8 text-sm font-medium opacity-80">
                <a href="#" class="hover:text-emerald-400 transition">Beranda</a>
                <a href="#products" class="hover:text-emerald-400 transition">Produk</a>
                <a href="#services" class="hover:text-emerald-400 transition">Layanan</a>
                <a href="#contact" class="hover:text-emerald-400 transition">Kontak</a>
            </div>
            <a href="https://wa.me/6289678745851?text=Halo%20UD%20Asnawi%20Jaya%202,%20saya%20mau%20tanya%20produk" class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-5 py-2 rounded-xl transition shadow-lg shadow-emerald-500/20">
                Hubungi Kami
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-20 px-6">
        <div class="container mx-auto text-center max-w-4xl">
            <h1 class="text-5xl md:text-7xl font-black mb-6 leading-tight">
                Bahan Bangunan<br><span class="text-gradient">Terlengkap & Terpercaya</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-400 mb-10 leading-relaxed">
                UD Asnawi Jaya 2 melayani kebutuhan bahan bangunan Anda dengan harga kompetitif dan kualitas terbaik. Besi, semen, dan semua kebutuhan konstruksi tersedia.
            </p>
            <div class="flex flex-col md:flex-row justify-center gap-4">
                <a href="https://wa.me/6289678745851?text=Halo%20UD%20Asnawi%20Jaya%202,%20saya%20mau%20tanya%20produk" class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-8 py-4 rounded-xl transition shadow-lg shadow-emerald-500/20">
                    Pesan via WhatsApp
                </a>
                <a href="#products" class="btn-glass px-8 py-4 rounded-xl font-bold">
                    Lihat Produk
                </a>
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Produk Unggulan</h2>
                <p class="text-slate-400">Kualitas terbaik untuk proyek Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Product 1 -->
                <div class="glass-card overflow-hidden">
                    <div class="h-64 bg-emerald-900/40 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-6xl">🔩</div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-2 mb-4">
                            <span class="text-[10px] px-2 py-1 rounded bg-emerald-500/10 border border-emerald-500/20 text-emerald-400 font-bold uppercase">Best Seller</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Besi Beton</h3>
                        <p class="text-slate-400 text-sm mb-4">Besi beton berkualitas tinggi untuk konstruksi yang kokoh. Tersedia berbagai ukuran.</p>
                        <a href="https://wa.me/6289678745851?text=Halo,%20saya%20tertarik%20dengan%20Besi%20Beton" class="text-emerald-400 font-bold hover:underline">Tanya Harga →</a>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="glass-card overflow-hidden">
                    <div class="h-64 bg-slate-800/40 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-6xl">🧱</div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-2 mb-4">
                            <span class="text-[10px] px-2 py-1 rounded bg-cyan-500/10 border border-cyan-500/20 text-cyan-400 font-bold uppercase">Stok Ready</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Semen</h3>
                        <p class="text-slate-400 text-sm mb-4">Semen berkualitas dari brand ternama untuk hasil bangunan yang kuat dan tahan lama.</p>
                        <a href="https://wa.me/6289678745851?text=Halo,%20saya%20tertarik%20dengan%20Semen" class="text-emerald-400 font-bold hover:underline">Tanya Harga →</a>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="glass-card overflow-hidden">
                    <div class="h-64 bg-amber-900/40 relative overflow-hidden">
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="text-6xl">🏗️</div>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex gap-2 mb-4">
                            <span class="text-[10px] px-2 py-1 rounded bg-amber-500/10 border border-amber-500/20 text-amber-400 font-bold uppercase">Lengkap</span>
                        </div>
                        <h3 class="text-2xl font-bold mb-2">Bahan Bangunan</h3>
                        <p class="text-slate-400 text-sm mb-4">Pasir, batu split, bata ringong, dan semua kebutuhan konstruksi lainnya tersedia.</p>
                        <a href="https://wa.me/6289678745851?text=Halo,%20saya%20tertarik%20dengan%20Bahan%20Bangunan" class="text-emerald-400 font-bold hover:underline">Tanya Harga →</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Layanan Kami</h2>
                <p class="text-slate-400">Solusi lengkap untuk kebutuhan bangunan Anda</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="glass-card p-8">
                    <div class="w-16 h-16 bg-emerald-500/10 rounded-2xl flex items-center justify-center mb-6 border border-emerald-500/20">
                        <svg class="w-8 h-8 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Pengiriman Cepat</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Layanan pengiriman ke lokasi proyek Anda dengan armada yang siap mengantar barang dengan aman dan tepat waktu.</p>
                </div>
                <div class="glass-card p-8">
                    <div class="w-16 h-16 bg-cyan-500/10 rounded-2xl flex items-center justify-center mb-6 border border-cyan-500/20">
                        <svg class="w-8 h-8 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-2xl font-bold mb-3">Konsultasi Gratis</h3>
                    <p class="text-slate-400 text-sm leading-relaxed">Konsultasikan kebutuhan bahan bangunan Anda dengan tim kami. Kami bantu menghitung kebutuhan material untuk proyek Anda.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 px-6">
        <div class="container mx-auto">
            <div class="glass-card p-12 text-center max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h2>
                <p class="text-slate-400 mb-8">Siap melayani kebutuhan bahan bangunan Anda</p>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div>
                        <div class="text-3xl mb-2">📍</div>
                        <div class="font-bold mb-1">Lokasi</div>
                        <div class="text-slate-400 text-sm">Gresik, Jawa Timur</div>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">📞</div>
                        <div class="font-bold mb-1">WhatsApp</div>
                        <div class="text-slate-400 text-sm">0896-7874-5851</div>
                    </div>
                    <div>
                        <div class="text-3xl mb-2">⏰</div>
                        <div class="font-bold mb-1">Jam Operasional</div>
                        <div class="text-slate-400 text-sm">08:00 - 16:00 WIB</div>
                    </div>
                </div>
                
                <a href="https://wa.me/6289678745851?text=Halo%20UD%20Asnawi%20Jaya%202,%20saya%20mau%20tanya%20produk" class="bg-emerald-500 hover:bg-emerald-400 text-slate-900 font-bold px-8 py-4 rounded-xl transition shadow-lg shadow-emerald-500/20 inline-flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Chat WhatsApp
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-white/5">
        <div class="container mx-auto px-6 text-center">
            <div class="text-2xl font-extrabold mb-4">
                <span class="text-emerald-400">UD Asnawi</span><span class="text-slate-400">Jaya 2</span>
            </div>
            <p class="text-slate-500 text-sm mb-4">Toko Bangunan Terpercaya di Gresik</p>
            <p class="text-slate-600 text-xs">&copy; 2026 UD Asnawi Jaya 2. Semua hak dilindungi.</p>
        </div>
    </footer>
</body>
</html>