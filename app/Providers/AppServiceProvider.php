<?php

namespace App\Providers;

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
        $functionClass = new class {

            /**
             * Public Function. Remove alert messages in session
             * @return String
             */
            public function clearAlert() { 
                $this->clearSessionAlert();
                return "Session alert closed successfully";
            }
            /**
             * Private Function. Remove alert messages in session
             * @return void
             */
            private function clearSessionAlert() { 
                \Session::forget(['alert-success','alert-warning','alert-danger']);
            }

        };

        // Here we declare the variables that we want to share in ALL the views from the boot of the app
        \View::share('functionClass', $functionClass);

        // Here we declare the variables that we want to share in ALL the views from the boot of the app
        \View::share('categories', \App\Category::all());

        // Retorna cualquier precio en formato $0,00 con @money($precio) dentro del HTML
        \Blade::directive('money', function ($price) {
            return "<?php echo number_format($price, 2, ',', ''); ?>";
        });
    
    }
}
