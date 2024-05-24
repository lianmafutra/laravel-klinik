<?php

namespace App\Providers;

use App\Config\MenuSidebar;
use App\Models\Obat;
use App\Models\PemeriksaanObat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    *
    * @return void
    */
   public function register()
   {
      //
   }

   /**
    * Bootstrap any application services.
    *
    * @return void
    */
   public function boot()
   {
      // Model::preventLazyLoading(!$this->app->isProduction());

      
      Blade::directive('rupiah', function ($expression) {
         return "Rp. <?php echo number_format($expression,0,',','.'); ?>";
      });

  
      Blade::directive('tanggal', function ($expression) {
         return "<?php echo \Carbon\Carbon::parse($expression)->translatedFormat('d-m-y H:i:s'); ?>";
      });

      view()->composer('admin.layouts.navbar', function ($view) {
         if (Auth::check()) {
            $view->with('fotoProfil', auth()->user()->field('foto')->getThumb());
         }
      });

      view()->composer('admin.layouts.sidebar', function ($view) {
         if (Auth::check()) {
            $view->with('menu', MenuSidebar::render());
         }
      });

      // view()->composer('*', function ($view) {
      // });
   }
}
