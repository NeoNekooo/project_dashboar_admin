@extends('adminlte::auth.auth-page') {{-- Tetap menggunakan layout default Anda --}}

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-5 col-md-7 col-sm-9"> {{-- Sesuaikan lebar card untuk tampilan lebih senter --}}
            <div class="card shadow-lg p-3 mb-5 bg-white rounded"> {{-- Tambahkan shadow dan padding --}}
                <div class="card-header bg-primary text-white text-center py-3 rounded-top"> {{-- Header yang lebih menonjol --}}
                    <h3>{{ __('Selamat Datang!') }}</h3>
                    <p class="mb-0">{{ __('Silakan login untuk melanjutkan.') }}</p>
                </div>

                <div class="card-body px-4 pt-4 pb-0">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        {{-- Username Input --}}
                        <div class="form-group mb-3"> {{-- Menggunakan form-group untuk input --}}
                            <label for="name" class="form-label">{{ __('Nama Pengguna') }}</label>
                            <input id="name" type="text"
                                class="form-control form-control-lg @error('name') is-invalid @enderror" {{-- form-control-lg untuk ukuran lebih besar --}}
                                name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                                placeholder="{{ __('Masukkan nama pengguna Anda') }}"> {{-- Tambahkan placeholder --}}
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Password Input --}}
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">{{ __('Kata Sandi') }}</label>
                            <input id="password" type="password"
                                class="form-control form-control-lg @error('password') is-invalid @enderror"
                                name="password" required autocomplete="current-password"
                                placeholder="{{ __('Masukkan kata sandi Anda') }}">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Remember Me Checkbox --}}
                        <div class="form-group mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                    {{ old('remember') ? 'checked' : '' }}>
                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat Saya') }}
                                </label>
                            </div>
                        </div>

                        {{-- reCAPTCHA Checkbox - DIHAPUS SEMENTARA --}}
                        {{-- <div class="form-group mb-4">
                            {!! NoCaptcha::display() !!}
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                            @endif
                        </div> --}}

                        {{-- Login Button --}}
                        <div class="d-grid gap-2 mb-3">
                            <button type="submit" class="btn btn-primary btn-lg">
                                {{ __('Login') }}
                            </button>
                        </div>

                        {{-- Forgot Password Link --}}
                        @if (Route::has('password.request'))
                            <p class="text-center mb-0">
                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    {{ __('Lupa Kata Sandi Anda?') }}
                                </a>
                            </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>