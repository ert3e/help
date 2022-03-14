<?php

use App\Models\UserBase;
use App\Modules\Admin\Positions\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{

    public static $positions = [
        UserBase::USER => 'Пользователь',
        UserBase::ROOT => 'Главный администратор',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(self::$positions as $id => $title) {
            Position::create([
                'id'    => $id,
                'title' => $title,
            ]);
        }
    }
}
