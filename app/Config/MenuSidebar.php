<?php
namespace App\Config;
class MenuSidebar
{
   public static function render()
   {
      return collect([
         [
            'type' => 'header',
            'title' => 'App Settings',
            'permission' => ['dashboard-app'],
         ],
         [
            'type' => 'menu',
            'title' => 'Dashboard Admin',
            'url' => route('dashboard'),
            'icon' => 'fas fa-tachometer-alt',
            'active' => ['admin/dashboard*'],
            'permission' => ['dashboard-app'],
         ],
         [
            'type' => 'tree',
            'title' => 'Role Permissions',
            'url' => '#',
            'icon' => 'fas fa-user-shield',
            'active' => ['admin/app/*'],
            'permission' => ['role_permissions'],
            'items' => [
               [
                  'type' => 'menu',
                  'title' => 'Master User',
                  'url' => route('master-user.index'),
                  'icon' => 'fas fa-user',
                  'active' => ['admin/app/master-user*'],
               ],
               [
                  'type' => 'menu',
                  'title' => 'Role',
                  'url' => route('role.index'),
                  'icon' => 'fas fa-user-cog',
                  'active' => ['admin/app/role*'],
               ],
               [
                  'type' => 'menu',
                  'title' => 'Permissions Group',
                  'url' => route('permission-group.index'),
                  'icon' => 'fas fa-layer-group',
                  'active' => ['admin/app/permission-group*'],
               ],
               [
                  'type' => 'menu',
                  'title' => 'Permissions',
                  'url' => route('permission.index'),
                  'icon' => 'fas fa-unlock',
                  'active' => ['admin/app/permission/*', 'admin/app/permission'],
               ],
            ],
         ],
         [
            'type' => 'menu',
            'title' => 'Settings',
            'url' => route('settings.index'),
            'icon' => 'fas fa-cog',
            'active' => ['admin/settings'],
            'permission' => ['settings'],
         ],
         [
            'type' => 'header',
            'title' => 'Data Master',
         ],
        
         [
            'type' => 'menu',
            'title' => 'Master Obat',
            'url' => route('master-data.obat.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['master-data/obat*'],
         ],
         [
            'type' => 'menu',
            'title' => 'Master Tindakan',
            'url' => route('settings.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['admin/settings'],
            'permission' => ['settings'],
         ],
         [
            'type' => 'menu',
            'title' => 'Master Anggota',
            'url' => route('master-data.user.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['master-data/user*'],
           
         ],
         [
            'type' => 'menu',
            'title' => 'Master Dokter',
            'url' => route('master-data.dokter.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['master-data/dokter*'],
          
         ],
         [
            'type' => 'header',
            'title' => 'Menu',
         ],
         [
            'type' => 'menu',
            'title' => 'Dashboard',
            'url' => route('klinik.dashboard.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['dashboard*'],
          
         ],
         // [
         //    'type' => 'menu',
         //    'title' => ' Rekam Medis',
         //    'url' => route('settings.index'),
         //    'icon' => 'fas fa-angle-right',
         //    'active' => ['admin/settings'],
         //    'permission' => ['settings'],
         // ],
         [
            'type' => 'menu',
            'title' => 'Pemeriksaan',
            'url' => route('pemeriksaan.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['pemeriksaan*'],
            
         ],
         [
            'type' => 'menu',
            'title' => 'Laporan',
            'url' => route('settings.index'),
            'icon' => 'fas fa-angle-right',
            'active' => ['admin/settings'],
            'permission' => ['settings'],
         ],
         [
            'type' => 'header',
            'title' => 'Menu App',
         ],
         [
            'type' => 'menu',
            'title' => 'Beranda',
            'url' => route('beranda.index'),
            'icon' => 'fas fa-home',
            'active' => ['beranda*'],
         ],
         // [
         //    'type'   => 'tree',
         //    'title'  => 'Sample Data',
         //    'url'    => '#',
         //    'icon'   => 'fas fa-folder-open',
         //    'active' => ['sample-crud*'],
         //    'permission' => 'sample_data',
         //    'items' => [
         //       [
         //          'type'   => 'menu',
         //          'title'  => 'Form Component',
         //          'url'    => route('sample-crud.create'),
         //          'icon'   => 'fas fa-folder-open',
         //          'active' => ['sample-crud/create']
         //       ],
         //       [
         //          'type'   => 'menu',
         //          'title'  => 'Datatable',
         //          'url'    => route('sample-crud.index'),
         //          'icon'   => 'fas fa-table',
         //          'active' => ['sample-crud']
         //       ],
         //    ],
         // ],
         // [
         //    'type' => 'menu',
         //    'title' => 'Data User',
         //    'url' => route('data-user.index'),
         //    'icon' => 'fas fa-users',
         //    'active' => ['data-user*'],
         //    'permission' => ['master-user-list'],
         // ],
         [
            'type' => 'menu',
            'title' => 'Profile',
            'url' => route('user.profile'),
            'icon' => 'fas fa-user-alt',
            'active' => ['user/profile*'],
         ],
      ]);
   }
}
