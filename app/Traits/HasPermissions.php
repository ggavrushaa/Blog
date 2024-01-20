<?php 

namespace App\Traits;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasPermissions
{
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class);
    }
    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class);
    }
 
    public function hasPermission(string $action, string $model): bool
    {
       return $this->hasDirectPermission($action, $model)
       || $this->hasRolePermission($action, $model);
    }

    public function hasDirectPermission(string $action, string $model): bool
    {
        return $this->permissions
        ->where('action', $action)
        ->where('model', $model)
        ->isNotEmpty();
    }
    public function hasRolePermission(string $action, string $model): bool
    {
        $this->roles->loadMissing('permissions');

        foreach($this->roles as $role) {
            $exists = $role->permissions
            ->where('action', $action)
            ->where('model', $model)
            ->isNotEmpty();

            if($exists) {
                return true;
            }
        }
        return false;
    }

}