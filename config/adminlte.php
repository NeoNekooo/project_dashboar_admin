<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Here you can change the default title of your admin panel.
    |
    | For detailed instructions you can look the title section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'title' => 'AdminLTE 3',
    'title_prefix' => '',
    'title_postfix' => '',

    /*
    |--------------------------------------------------------------------------
    | Favicon
    |--------------------------------------------------------------------------
    |
    | Here you can activate the favicon.
    |
    | For detailed instructions you can look the favicon section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_ico_only' => false,
    'use_full_favicon' => false,

    /*
    |--------------------------------------------------------------------------
    | Google Fonts
    |--------------------------------------------------------------------------
    |
    | Here you can allow or not the use of external google fonts. Disabling the
    | google fonts may be useful if your admin panel internet access is
    | restricted somehow.
    |
    | For detailed instructions you can look the google fonts section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'google_fonts' => [
        'allowed' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Logo
    |--------------------------------------------------------------------------
    |
    | Here you can change the logo of your admin panel.
    |
    | For detailed instructions you can look the logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'logo' => 'PPDB', // Tetap statis di sini, dinamisasi dilakukan di Blade
    'logo_img' => 'vendor/adminlte/dist/img/AdminLTELogo.png', // Tetap statis di sini
    'logo_img_alt' => 'Admin Logo',

    /*
    |--------------------------------------------------------------------------
    | Authentication Logo
    |--------------------------------------------------------------------------
    |
    | Here you can setup an alternative logo to use on your login and register
    | screens. When disabled, the admin panel logo will be used instead.
    |
    | For detailed instructions you can look the auth logo section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'auth_logo' => [
        'enabled' => false, // Tetap false agar logo di config 'logo' yang dipakai
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'Auth Logo',
            'class' => '',
            'width' => 50,
            'height' => 50,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Preloader Animation
    |--------------------------------------------------------------------------
    |
    | Here you can change the preloader animation configuration. Currently, two
    | modes are supported: 'fullscreen' for a fullscreen preloader animation
    | and 'cwrapper' to attach the preloader animation into the content-wrapper
    | element and avoid overlapping it with the sidebars and the top navbar.
    |
    | For detailed instructions you can look the preloader section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'preloader' => [
        'enabled' => false,
        'mode' => 'fullscreen',
        'img' => [
            'path' => 'vendor/adminlte/dist/img/AdminLTELogo.png',
            'alt' => 'AdminLTE Preloader Image',
            'effect' => 'animation__shake',
            'width' => 60,
            'height' => 60,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Menu
    |--------------------------------------------------------------------------
    |
    | Here you can activate and change the user menu.
    |
    | For detailed instructions you can look the user menu section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'usermenu_enabled' => true,
    'usermenu_header' => false,
    'usermenu_header_class' => 'bg-primary',
    'usermenu_image' => false,
    'usermenu_desc' => false,
    'usermenu_profile_url' => false,

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | Here we change the layout of your admin panel.
    |
    | For detailed instructions you can look the layout section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'layout_topnav' => null,
    'layout_boxed' => null,
    'layout_fixed_sidebar' => null,
    'layout_fixed_navbar' => null,
    'layout_fixed_footer' => '',
    'layout_dark_mode' => null,

    /*
    |--------------------------------------------------------------------------
    | Authentication Views Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the authentication views.
    |
    | For detailed instructions you can look the auth classes section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_auth_card' => 'card-outline card-primary',
    'classes_auth_header' => '',
    'classes_auth_body' => '',
    'classes_auth_footer' => '', // Ini sudah Anda tambahkan untuk menyembunyikan footer di halaman auth
    'classes_auth_icon' => '',
    'classes_auth_btn' => 'btn-flat btn-primary',

    /*
    |--------------------------------------------------------------------------
    | Admin Panel Classes
    |--------------------------------------------------------------------------
    |
    | Here you can change the look and behavior of the admin panel.
    |
    | For detailed instructions you can look the admin panel classes here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'classes_body' => '',
    'classes_brand' => '',
    'classes_brand_text' => '',
    'classes_content_wrapper' => '',
    'classes_content_header' => '',
    'classes_content' => '',
    'classes_sidebar' => 'sidebar-dark-primary elevation-4',
    'classes_sidebar_nav' => '',
    'classes_topnav' => 'navbar-white navbar-light',
    'classes_topnav_nav' => 'navbar-expand',
    'classes_topnav_container' => 'container',

    /*
    |--------------------------------------------------------------------------
    | Sidebar
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar of the admin panel.
    |
    | For detailed instructions you can look the sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'sidebar_mini' => 'lg',
    'sidebar_collapse' => false,
    'sidebar_collapse_auto_size' => false,
    'sidebar_collapse_remember' => false,
    'sidebar_collapse_remember_no_transition' => true,
    'sidebar_scrollbar_theme' => 'os-theme-light',
    'sidebar_scrollbar_auto_hide' => 'l',
    'sidebar_nav_accordion' => true,
    'sidebar_nav_animation_speed' => 300,

    /*
    |--------------------------------------------------------------------------
    | Control Sidebar (Right Sidebar)
    |--------------------------------------------------------------------------
    |
    | Here we can modify the right sidebar aka control sidebar of the admin panel.
    |
    | For detailed instructions you can look the right sidebar section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Layout-and-Styling-Configuration
    |
    */

    'right_sidebar' => false,
    'right_sidebar_icon' => 'fas fa-cogs',
    'right_sidebar_theme' => 'dark',
    'right_sidebar_slide' => true,
    'right_sidebar_push' => true,
    'right_sidebar_scrollbar_theme' => 'os-theme-light',
    'right_sidebar_scrollbar_auto_hide' => 'l',

    /*
    |--------------------------------------------------------------------------
    | URLs
    |--------------------------------------------------------------------------
    |
    | Here we can modify the url settings of the admin panel.
    |
    | For detailed instructions you can look the urls section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Basic-Configuration
    |
    */

    'use_route_url' => false,
    'dashboard_url' => 'home',
    'logout_url' => 'logout',
    'login_url' => 'login',
    'register_url' => 'register',
    'password_reset_url' => 'password/reset',
    'password_email_url' => 'password/email',
    'profile_url' => false,
    'disable_darkmode_routes' => false,

    /*
    |--------------------------------------------------------------------------
    | Laravel Asset Bundling
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Laravel Asset Bundling option for the admin panel.
    | Currently, the next modes are supported: 'mix', 'vite' and 'vite_js_only'.
    | When using 'vite_js_only', it's expected that your CSS is imported using
    | JavaScript. Typically, in your application's 'resources/js/app.js' file.
    | If you are not using any of these, leave it as 'false'.
    |
    | For detailed instructions you can look the asset bundling section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'laravel_asset_bundling' => false,
    'laravel_css_path' => 'css/app.css',
    'laravel_js_path' => 'js/app.js',

    /*
    |--------------------------------------------------------------------------
    | Menu Items
    |--------------------------------------------------------------------------
    |
    | Here we can modify the sidebar/top navigation of the admin panel.
    |
    | For detailed instructions you can look here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */
    'menu' => [
        // Item menu Dashboard Utama (selalu tampil untuk semua yang login)
        [
            'text'          => 'Dashboard',
            'url'           => 'dashboard', // Atau 'dashboard.main' jika Anda pakai route() helper
            'icon'          => 'fas fa-fw fa-tachometer-alt',
            'can'           => 'user', // Tampil jika user terautentikasi (gate 'user' selalu true)
        ],

        // Menu khusus Admin (tampil jika user memiliki gate 'admin')
        [
            'text'          => 'INSTANSI', // Menu ini
            'icon'          => 'fas fa-building',
            'can'           => 'admin', // <-- Pastikan ini ada untuk membatasi akses ke admin
            'submenu'       => [
                [
                    'text' => 'Profil',
                    'url'  => 'instansi/profile#profil',
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Gambar',
                    'url'  => 'instansi/profile#gambar',
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Alamat',
                    'url'  => 'instansi/profile#alamat',
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Peta',
                    'url'  => 'instansi/profile#peta',
                    'icon' => 'far fa-circle',
                ],
            ],
            // Pastikan regex untuk 'active' sudah benar
            'active' => ['instansi/profile*', 'regex:#^instansi/profile(\#[a-zA-Z0-9_-]+)?$#'],
        ],

        [
            'text'          => 'Kepegawaian',
            'icon'          => 'fas fa-fw fa-users',
            'submenu'       => [
                [
                    'text'      => 'Data Pegawai',
                    'icon'      => 'far fa-address-card', // Ikon untuk sub-menu Data Pegawai
                    'submenu'   => [ // Bagian ini penting untuk membuat bersarang
                        [
                            'text' => 'Pendidik Aktif',
                            'route'  => 'kepegawaian.pendidik.index', // Menggunakan route name
                            'icon' => 'fas fa-user-check', // Ikon untuk pendidik aktif
                            'active' => ['kepegawaian/pendidik'] // Active untuk /pendidik dan turunannya, kecuali /tidak-aktif dan /tenaga-kependidikan
                        ],
                        [
                            'text' => 'Tenaga Kependidikan',
                            'route'  => 'kepegawaian.tenaga_kependidikan.index', // Menggunakan route name
                            'icon' => 'fas fa-user-tie', // Ikon untuk tenaga kependidikan
                            'active' => ['kepegawaian/tenaga-kependidikan', 'kepegawaian/tenaga-kependidikan/*'] // Active khusus untuk tenaga kependidikan
                        ],
                        [
                            'text' => 'pegawai Tidak Aktif',
                            'route'  => 'kepegawaian.pendidik.inactive', // Menggunakan route name
                            'icon' => 'fas fa-user-times', // Ikon untuk pendidik tidak aktif
                            'active' => ['kepegawaian/pendidik/tidak-aktif'] // Active khusus untuk /tidak-aktif
                        ],
                    ],
                    'active' => ['kepegawaian/pendidik*', 'kepegawaian/tenaga-kependidikan*'] // Active untuk semua yang ada di bawah Data Pegawai (misal: /pendidik, /pendidik/create, /pendidik/tidak-aktif, /tenaga-kependidikan)
                ],
                 [
                'text' => 'Tugas Pokok',
                'url'  => 'akademik/main_tasks', // URL yang mengarah ke daftar tugas pokok
                'icon' => 'far fa-circle',
                'active' => ['akademik/main_tasks*'], // Aktifkan ketika berada di halaman tugas pokok
                ],
                [
                    'text' => 'Pelaksanaan Tugas Harian',
                    'url'  => '#',
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Mutasi Pegawai',
                    'url'  => '#',
                    'icon' => 'far fa-circle',
                ],
            ],
        ],

        [
            'text'          => 'Akademik',
            'icon'          => 'fas fa-fw fa-building', // Menggunakan icon gedung sebagai representasi akademik
            'submenu'       => [
                [
                    'text' => 'Tahun Pelajaran',
                    'url'  => 'akademik/tapel',
                    'icon' => 'far fa-circle',
                ],
                // Tambahkan menu Semester di sini
                [
                    'text' => 'Semester',
                    'url'  => 'akademik/semesters', // URL yang mengarah ke daftar semester
                    'icon' => 'far fa-circle',
                    'active' => ['akademik/semesters'], // Aktifkan ketika berada di halaman semester
                ],
                [
                    'text' => 'Program Keahlian',
                    'url'  => '#', // Placeholder URL
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Paket Keahlian',
                    'url'  => '#', // Placeholder URL
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Mata Pelajaran',
                    'url'  => '#', // Placeholder URL
                    'icon' => 'far fa-circle',
                ],
                [
                    'text' => 'Ekstrakurikuler',
                    'url'  => '#', // Placeholder URL
                    'icon' => 'far fa-circle',
                ],
            ],
            'active' => ['akademik/*', 'regex:#^akademik(\#[a-zA-Z0-9_-]+)?$#'], // Aktifkan jika ada URL spesifik
        ],

        // Menu khusus Guru (tampil jika user memiliki gate 'guru')
        [
            'text'          => 'Menu Guru',
            'icon'          => 'fas fa-fw fa-chalkboard-teacher',
            'can'           => 'guru',
            'submenu'       => [
                ['text' => 'Dashboard Guru', 'url' => 'dashboard', 'icon' => 'fas fa-fw fa-tachometer-alt'],
                ['text' => 'Materi Pelajaran', 'url' => 'guru/materi', 'icon' => 'fas fa-fw fa-book'],
            ],
        ],

        // Menu khusus Siswa (tampil jika user memiliki gate 'siswa')
        [
            'text'          => 'Menu Siswa',
            'icon'          => 'fas fa-fw fa-user-graduate',
            'can'           => 'siswa',
            'submenu'       => [
                ['text' => 'Dashboard Siswa', 'url' => 'dashboard', 'icon' => 'fas fa-fw fa-tachometer-alt'],
                ['text' => 'Tugas-tugas', 'url' => 'siswa/tugas', 'icon' => 'fas fa-fw fa-tasks'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Menu Filters
    |--------------------------------------------------------------------------
    |
    | Here we can modify the menu filters of the admin panel.
    |
    | For detailed instructions you can look the menu filters section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Menu-Configuration
    |
    */

    'filters' => [
        JeroenNoten\LaravelAdminLte\Menu\Filters\GateFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\HrefFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\SearchFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ActiveFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\ClassesFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\LangFilter::class,
        JeroenNoten\LaravelAdminLte\Menu\Filters\DataFilter::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Plugins Initialization
    |--------------------------------------------------------------------------
    |
    | Here we can modify the plugins used inside the admin panel.
    |
    | For detailed instructions you can look the plugins section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Plugins-Configuration
    |
    */

    'plugins' => [
        'Datatables' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css',
                ],
            ],
        ],
        'Select2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js',
                ],
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.css',
                ],
            ],
        ],
        'Chartjs' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.0/Chart.bundle.min.js',
                ],
            ],
        ],
        'Sweetalert2' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdn.jsdelivr.net/npm/sweetalert2@8',
                ],
            ],
        ],
        'Pace' => [
            'active' => false,
            'files' => [
                [
                    'type' => 'css',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/themes/blue/pace-theme-center-radar.min.css',
                ],
                [
                    'type' => 'js',
                    'asset' => false,
                    'location' => '//cdnjs.cloudflare.com/ajax/libs/pace/1.0.2/pace.min.js',
                ],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | IFrame
    |--------------------------------------------------------------------------
    |
    | Here we change the IFrame mode configuration. Note these changes will
    | only apply to the view that extends and enable the IFrame mode.
    |
    | For detailed instructions you can look the iframe mode section here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/IFrame-Mode-Configuration
    |
    */

    'iframe' => [
        'default_tab' => [
            'url' => null,
            'title' => null,
        ],
        'buttons' => [
            'close' => true,
            'close_all' => true,
            'close_all_other' => true,
            'scroll_left' => true,
            'scroll_right' => true,
            'fullscreen' => true,
        ],
        'options' => [
            'loading_screen' => 1000,
            'auto_show_new_tab' => true,
            'use_navbar_items' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Livewire
    |--------------------------------------------------------------------------
    |
    | Here we can enable the Livewire support.
    |
    | For detailed instructions you can look the livewire here:
    | https://github.com/jeroennoten/Laravel-AdminLTE/wiki/Other-Configuration
    |
    */

    'livewire' => false,
];
