<?php

namespace App\Policies;

use App\Product;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any products.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the product.
     *
     * @param User $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function view(User $user)
    {
        return $user->checkPermissionAccess('product_list');
    }

    /**
     * Determine whether the user can create products.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        return $user->checkPermissionAccess('product_add');
    }

    /**
     * Determine whether the user can update the product.
     *
     * @param User $user
     * @param $id
     * @return mixed
     */
    public function update(User $user, $id)
    {
        if ($user->checkPermissionAccess('product_edit') || $user->id === $id )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the product.
     *
     * @param User $user
     * @param $id
     * @return mixed
     */
    public function delete(User $user, $id)
    {
        if ($user->checkPermissionAccess('product_delete') || $user->id === $id )
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the product.
     *
     * @param User $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function restore(User $user, Product $product)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the product.
     *
     * @param User $user
     * @param  \App\Product  $product
     * @return mixed
     */
    public function forceDelete(User $user, Product $product)
    {
        //
    }
}
