<div class="card border-0 shadow-sm rounded-4 mb-4 text-white" style="background-color: #1e3a5f;">
    <div class="card-body p-5">
        <div class="d-flex {{ Route::is('home') ? 'justify-content-between' : 'justify-content-end' }} align-items-start">
            
            @if(Route::is('home'))
            <div class="col-md-8">
                <h2 class="fw-bold mb-3">Selamat Datang, {{ Auth::user()->username }}</h2>
                <p class="opacity-75 mb-4" style="max-width: 500px;">
                    Dashboard ini menampilkan ringkasan operasional sistem. Pantau aktivitas sistem dengan cepat melalui halaman ini.
                </p>
                <button class="btn btn-light rounded-pill px-4 fw-bold shadow-sm">Lihat Laporan</button>
            </div>
            @endif

            <div class="dropdown">
                <a href="#" class="d-flex align-items-center bg-opacity-10 p-2 px-3 text-decoration-none dropdown-toggle" 
                    id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="rounded-circle border border-2 border-white bg-light text-dark d-flex align-items-center justify-content-center fw-bold shadow-sm" 
                        style="width: 40px; height: 40px; font-size: 14px;">
                        {{ strtoupper(substr(Auth::user()->username, 0, 2)) }}
                    </div>
                </a>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3 mt-2" aria-labelledby="profileDropdown">
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center fw-bold">
                                <i class="bi bi-box-arrow-right me-2"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>