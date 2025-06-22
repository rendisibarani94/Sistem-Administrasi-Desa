<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// use App\View\Composers\SettingComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
// use App\View\Components\NavPlusLink;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    // View::composer('Components.layouts.masyarakat', SettingComposer::class);
        Blade::directive('rupiah', function ($expression) {
        return "<?php echo 'Rp. ' . number_format($expression, 0, ',', '.'); ?>";
    });

    $settings = DB::table('settings')->pluck('value', 'key')->toArray();
    View::share('settings', $settings);

        $kepala_desa = DB::table('aparatur_desa')
        ->where('is_deleted', 0)
        ->where('jabatan', 'Kepala Desa')
        ->where('is_active', 1)
        ->value('nama_lengkap');

        $sekretaris = DB::table('aparatur_desa')
        ->where('is_deleted', 0)
        ->where('jabatan', 'Sekretaris Desa')
        ->where('is_active', 1)
        ->value('nama_lengkap');

    View::share('kepala_desa', $kepala_desa);
    View::share('sekretaris', $sekretaris);

    }
}
