<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use App\Models\Alquiler;
use App\Models\Usuario;
use Illuminate\Support\Facades\Gate;


class AppServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(){
        $this->registerPolicies();

        Gate::define('isAdmin', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'Admin';
        });

        Gate::define('isEmpleado', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'App\Models\Empleado';
        });

        Gate::define('isEmpleadoOrAdmin', function() {
            return Gate::allows("isEmpleado") or Gate::allows("isAdmin");
        });

        Gate::define('isClient', function(Usuario $usuario) {
            return $usuario->utenteable_type == 'App\Models\Cliente';
        });

        Gate::define('doesntHaveAlquiler', function(Usuario $usuario) {
            return Gate::allows("isClient") and !Alquiler::where("clienteID", $usuario->utenteable_id)->where("activo", true)->exists();
        });
    }
}
