<?php

namespace App\Main;

class TopMenu
{
    /**
     * List of side menu items.
     */
    public static function menu(): array
    {
        $menu = [
            'dashboard' => [
                'icon' => 'home',
                'route_name' => 'dashboard-overview-3',
                'title' => 'Dashboard',
            ],
        ];

        if (auth()->guard('admin')->check()) {
            $menu = [
                'halaman-utama' => [
                    'icon' => 'home',
                    'route_name' => 'dashboard-overview-2',
                    'title' => 'Halaman Utama',
                ],
                'halaman-kedua' => [
                    'icon' => 'pencil',
                    'route_name' => 'mahasiswaBaruView',
                    'title' => 'Tambah Akun Mahasiswa',
                ],
            ];
        }

        if (auth()->guard('mahasiswa')->check()) {
            $menu = [
                'halaman-utama' => [
                    'icon' => 'scroll-text',
                    'route_name' => 'dashboard-overview-3',
                    'title' => 'Formulir Pendaftaran',
                ],
            ];
        }

        return $menu;
    }
}
