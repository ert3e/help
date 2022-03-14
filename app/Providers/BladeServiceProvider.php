<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->afterResolving('blade.compiler', function (\Illuminate\View\Compilers\BladeCompiler $bladeCompiler) {
            $bladeCompiler->directive('each', function ($expression) use ($bladeCompiler) {
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->getFinder()->flush(); \$__env->getFinder()->prependLocation('{$path}'); echo \$__env->renderEach({$expression}); ?>";
            });

            $bladeCompiler->directive('include', function ($expression) use ($bladeCompiler) {
                if (\Illuminate\Support\Str::startsWith($expression, '(')) {
                    $expression = substr($expression, 1, -1);
                }
                $path = dirname($bladeCompiler->getPath());

                return "<?php \$__env->getFinder()->flush(); \$__env->getFinder()->prependLocation('{$path}'); echo \$__env->make({$expression}, \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>";
            });

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
