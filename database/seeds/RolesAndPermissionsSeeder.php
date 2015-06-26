<?php
/*
|--------------------------------------------------------------------------
| Roles & Permissions Seeder
|--------------------------------------------------------------------------
|
| This Seeder class allows you to update and create Roles & Permissions 
| for the Laravel Entrust package. 
|
| USE -> php artisan db:seed --class=RolesAndPermissionsSeeder
| 
| https://github.com/thomasfw/RolesAndPermissionsSeeder
|
|--------------------------------------------------------------------------
| Make sure you update the namespaces for your User & Entrust models
|--------------------------------------------------------------------------
*/
use App\Models\Permission;
use App\Models\Role;
use App\User;
use Illuminate\Database\Seeder;

class RolesAndPermissionsSeeder extends Seeder
{
    protected $roles = [
        'super_admin' => [
            'description' => 'Use this account with extreme caution. When using this account it is possible to cause irreversible damage to the system.',
            'permissions' => ['super_admin_permission']
        ],

        'admin' => [
            'description' => 'Access to manage users, orders and all stuff related with his company.',
            'permissions' => ['admin_permission']
        ],
        'user' => [
            'description' => 'Can only do basic functionality in a company assigned',
            'permissions' => ['user_permission']
        ],
    ];

    protected $permissions = [
        'super_admin_permission' => [
            'description' => 'Can do all that they want, it\'s a super administrator',
        ],

        'admin_permission' => [
            'description' => 'Can manage all data related with his company',
        ],
        'user_permission' => [
            'description' => 'Can manage the basic things in a company, create orders, change status, etc',
        ],
    ];

    /**
     * Run the Seeder
     *
     * @return void
     */
    public function run()
    {
        DB::table(Config::get('entrust.permissions_table'))->delete();
        DB::table('roles')->delete();
        foreach ($this->roles() as $key => $val) {
            $this->command->info(" ");
            $this->command->info('Creating/updating the \'' . $key . '\' role');
            $this->command->info('-----------------------------------------');
            $val['name'] = $key;
            $this->reset($val);
        }
        $this->cleanup();
    }

    /**
     * Roles
     *
     * @return array()
     */
    public function roles()
    {
        return $this->roles;
    }

    /**
     * Reset Role, Permissions & Users
     *
     * @param  $role
     * @return void
     */
    public function reset($role)
    {
        $commandBullet = '  -> ';

        // The Old Role
        $originalRole = Role::where('name', $role['name'])->first();
        if ($originalRole) Role::where('id', $originalRole->id)->update(['name' => $role['name'] . '__remove']);

        // The New Role
        $newRole = new Role();
        $newRole->name = $role['name'];
        if (isset($role['description'])) $newRole->description = $role['description']; // optional
        $newRole->save();
        $this->command->info($commandBullet . "Created $role[name] role");

        // Set the Permissions (if they exist)
        $pcount = 0;
        if (!empty($role['permissions'])) {
            foreach ($role['permissions'] as $permission_name) {

                $permission = $this->permissions($permission_name);
                if ($permission === false || (!$permission_name)) {
                    $this->command->error($commandBullet . "Failed to attach permission '$permission_name'. It does not exist");
                    continue;
                }

                $newPermission = Permission::where('name', $permission_name)->first();
                if (!$newPermission) {
                    $newPermission = new Permission();
                    $newPermission->name = key($permission);
                    if (isset($permission['description'])) $newPermission->description = $permission['description']; // optional
                    $newPermission->save();
                }
                $newRole->attachPermission($newPermission);
                $pcount++;
            }
        }
        $this->command->info($commandBullet . "Attached $pcount permissions to $role[name] role");

        // Update old records
        if ($originalRole) {
            $userCount = 0;
            $RoleUsers = DB::table(Config::get('entrust.role_user_table'))->where('role_id', $originalRole->id)->get();
            foreach ($RoleUsers as $user) {
                $u = User::where('id', $user->user_id)->first();
                $u->attachRole($newRole);
                $userCount++;
            }
            $this->command->info($commandBullet . "Updated role attachment for $userCount users");

            Role::where('id', $originalRole->id)->delete(); // will also remove old role_user records
            $this->command->info($commandBullet . "Removed the original $role[name] role");
        }
    }

    /**
     * Permissions
     *
     * @param  $name
     * @return array()
     */
    public function permissions($name = '')
    {
        $single = (array_key_exists($name, $this->permissions) ? array($name => $this->permissions[$name]) : false);
        return ($name ? $single : $this->permissions);
    }

    /**
     * Cleanup()
     * Remove any roles & permissions that have been removed
     * @return void
     */
    public function cleanup()
    {
        $commandBullet = '  -> ';
        $this->command->info(" ");
        $this->command->info('Cleaning up roles & permissions:');
        $this->command->info('--------------------------------');

        $storedRoles = Role::all();
        if (!empty($storedRoles)) {
            $definedRoles = $this->roles();
            foreach ($storedRoles as $role) {
                if (!array_key_exists($role->name, $definedRoles)) {
                    Role::where('name', $role->name)->delete();
                    $this->command->info($commandBullet . 'The \'' . $role->name . '\' role was removed');
                }
            }
        }
        $storedPerms = DB::table(Config::get('entrust.permissions_table'))->get();
        if (!empty($storedPerms)) {
            $definedPerms = $this->permissions();
            foreach ($storedPerms as $perm) {
                if (!array_key_exists($perm->name, $definedPerms)) {
                    DB::table(Config::get('entrust.permissions_table'))->where('name', $perm->name)->delete();
                    $this->command->info($commandBullet . 'The \'' . $perm->name . '\' permission was removed');
                }
            }
        }
        $this->command->info($commandBullet . 'Done');
        $this->command->info(" ");
    }

}