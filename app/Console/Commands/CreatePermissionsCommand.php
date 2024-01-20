<?php

namespace App\Console\Commands;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Gate;

class CreatePermissionsCommand extends Command
{
 
    protected $signature = 'permissions:create';
    protected $description = 'Command description';

    public function handle()
    {
        $this->createRoles();
        $this->createPermissions();
        $this->info('Заходи, не бойся');
        return Command::SUCCESS;
    }

    private function createRoles(): void
    {
        Role::query()->firstOrCreate([
            'name' => 'Супер админ',
            'super' => true,
        ]);
    }

    private function createPermissions(): void
    {
        $policies = Gate::policies();
        
        foreach ($policies as $model => $policy) {
            $methods = $this->getPolicyMethods($policy);
           foreach ($methods as $method) {
            Permission::query()
            ->firstOrCreate([
                'action' => $method,
                'model' => $model,
            ]);
           }
        }
    }

    private function getPolicyMethods(string $policy): array
    {
        $methods = get_class_methods($policy);

        return array_filter($methods, function (string $method) {
            return !in_array($method, [
                'denyWithStatus',
                'denyAsNotFound',
            ]);
        });
    }
}
