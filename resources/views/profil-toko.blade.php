@extends('layouts.app')

@section('title', 'Profil Toko - Sumber Unggas')

@section('content')
    <section id="profil-toko" style="padding: 120px 20px 80px; background-color: #ffffff;">
        <div style="max-width: 1200px; margin: 0 auto;">
            
            <div style="display: flex; flex-wrap: wrap; gap: 50px; align-items: center;">
                
                <div style="flex: 1; min-width: 300px;">
                    <div style="position: relative;">
                        <img src="{{ asset('images/logo-su.png') }}" alt="Profil Sumber Unggas" 
                             style="width: 100%; border-radius: 20px; box-shadow: 20px 20px 0px #e6f4ea;">
                        <div style="position: absolute; bottom: -20px; right: -20px; background: #16a34a; color: white; padding: 20px; border-radius: 15px; font-weight: bold;">
                            Terpercaya Sejak 2020
                        </div>
                    </div>
                </div>

                <div style="flex: 1.2; min-width: 300px;">
                    <h4 style="color: #16a34a; text-transform: uppercase; letter-spacing: 2px; font-weight: bold; margin-bottom: 10px;">
                        Profil Toko
                    </h4>
                    <h2 style="color: #0f766e; font-size: 36px; font-weight: bold; margin-bottom: 25px; line-height: 1.2;">
                        Solusi Kebutuhan Peternakan Unggas Anda
                    </h2>
                    
                    <p style="color: #4b5563; line-height: 1.8; font-size: 17px; margin-bottom: 30px; text-align: justify;">
                        Sumber Unggas adalah mitra setia peternak dalam menyediakan sarana produksi ternak yang berkualitas. 
                        Kami memahami bahwa keberhasilan panen dimulai dari input yang tepat, mulai dari pakan bernutrisi tinggi 
                        hingga perlindungan kesehatan melalui vaksinasi yang terjadwal.
                    </p>

                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="background: #e6f4ea; padding: 10px; border-radius: 50%;">✅</span>
                            <span style="color: #374151; font-weight: 500;">Pakan Berkualitas</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="background: #e6f4ea; padding: 10px; border-radius: 50%;">✅</span>
                            <span style="color: #374151; font-weight: 500;">Vaksin Original</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="background: #e6f4ea; padding: 10px; border-radius: 50%;">✅</span>
                            <span style="color: #374151; font-weight: 500;">Peralatan Lengkap</span>
                        </div>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <span style="background: #e6f4ea; padding: 10px; border-radius: 50%;">✅</span>
                            <span style="color: #374151; font-weight: 500;">Konsultasi Gratis</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection