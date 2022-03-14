<?php

use App\Models\UserBase;
use App\Modules\Admin\Users\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    private $admin = [
      'name'        => 'admin',
      'last_name'   => 'root',
      'email'       => 'admin@example.ru',
      'password'    => 123456,
      'position_id' => UserBase::ROOT,
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->admin['password'] = bcrypt($this->admin['password']);

        User::create($this->admin);
    }
}
