<?php

namespace App\Providers;

use App\Product;
use App\Services\PermissionGateAndPolicyAccess1;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $permissionGateAndPolicy = new PermissionGateAndPolicyAccess1();
        $permissionGateAndPolicy->setGateAndPolicyAccess();

//        Gate::define('product-list', function ($user) {
//            return $user->checkPermissionAccess('product_list');
//        });
//
//        Gate::define('product-edit', function ($user, $id) {
//            $product = Product::find($id);
//            if ($user->checkPermissionAccess('product_edit') && $user->id === $product->user_id)
//            {
//                return true;
//            }
//            return false;
//        });

//        Gate::define('admin_role_simple', function ($user) {
//
//            if ($user->roles_simple === 'admin')
//            {
//                return true;
//            }
//            return false;
//        });

        }

}
