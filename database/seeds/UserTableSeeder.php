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
use App\Models\Role as Role;
use App\User as User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{

    protected $users = [
        'carlos' => [
            'email' => 'carlos@yopmail.com',
            'password' => '123456',
            'roles' => array('super_admin')
        ],
    ];

    /**
     * Run the Seeder
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('es_ES');

        DB::table('users')->delete();

        $commandBullet = '  -> ';
        foreach ($this->users() as $key => $val) {
            $this->command->info(" ");
            $this->command->info('Creating/updating the \'' . $key . '\' user');
            $this->command->info('-----------------------------------------');
            $val['name'] = $key;

            $newUser = new User();
            $newUser->email = $val['email'];
            $newUser->name = $key;
            $newUser->password = bcrypt($val['password']);
            $newUser->activated = true;
            $newUser->save();

            $roles = array();
            foreach ($val['roles'] as $role) {
                $roleObj = Role::where('name', '=', $role)->firstOrFail();
                $roles[] = $roleObj->id;
            }

            $newUser->roles()->sync($roles, true);

            $this->command->info($commandBullet . "Created $val[name] user");
        }
        $this->command->info($commandBullet . 'Done');
        $this->command->info(" ");
    }

    /**
     * Users
     *
     * @return array()
     */
    public function users()
    {
        return $this->users;
    }
}