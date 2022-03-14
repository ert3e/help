<?php

use App\Models\UserBase;
use App\Modules\Admin\Positions\Models\PositionPrivilege;
use App\Modules\Admin\Positions\Models\Privilege;
use Illuminate\Database\Seeder;

class PositionsPrivilegesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Privilege::all() as $privilege) {
            PositionPrivilege::create([
                'position_id'   => UserBase::ROOT,
                'privilege_id'  => $privilege['id'],
            ]);
        }
    }
}
