@extends('layouts.app')

@section('title', 'Kontak - Sumber Unggas')

@section('content')

    <section class="text-center mt-60 fade-in" style="padding-top: 1px;">
        <div class="container">
            <h2 class="page-title">Hubungi Kami</h2>
            <p class="katalog-subtitle">Kami siap membantu Anda. Jangan ragu untuk menghubungi kami!</p>
        </div>
    </section>

    <section class="mt-40 mb-40 fade-in">
        <div class="container">
            <div class="contact-grid">
                
                <div class="contact-card shadow-card">
                    <h3>Informasi Kontak</h3>
                    <ul class="contact-list">
                        <li>
                            <div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="contact-text">
                                <strong>Alamat</strong>
                                <p>Jl. Peternakan Raya No. 123, Jakarta Timur</p>
                            </div>
                        </li>
                        <li>
                            <div class="icon-circle"><i class="fas fa-phone-alt"></i></div>
                            <div class="contact-text">
                                <strong>Telepon</strong>
                                <p>+62 812-3456-7890</p>
                            </div>
                        </li>
                    </ul>
                    <a href="https://wa.me/ " target="_blank" class="btn btn-wa">
                        <i class="fab fa-whatsapp"></i> Hubungi via WhatsApp
                    </a>
                </div>

                <div class="contact-card shadow-card">
                    <h3>Lokasi Toko</h3>
                    <div class="map-wrapper">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.736009852233!2d106.899738!3d-6.298371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTcnNTQuMSJTIDEwNsKwNTQnMDkuMSJF!5e0!3m2!1sen!2sid!4v1620000000000!5m2!1sen!2sid" width="100%" height="320" style="border:0;" loading="lazy"></iframe>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="mb-80 fade-in">
        <div class="container">
            <div class="consultation-box">
                <div class="consultation-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h2>Butuh Konsultasi?</h2>
                <p>Tim ahli kami siap membantu Anda memilih pakan dan vaksin yang paling tepat untuk mengoptimalkan hasil peternakan Anda. Jangan ragu untuk bertanya!</p>
                
                <div class="consultation-buttons">
                    <a href="https://wa.me/6281234567890" target="_blank" class="btn btn-wa-solid">
                        <i class="fab fa-whatsapp"></i> Chat WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection