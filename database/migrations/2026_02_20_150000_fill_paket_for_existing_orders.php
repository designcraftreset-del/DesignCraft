<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        $driver = DB::getDriverName();
        if ($driver === 'mysql') {
            DB::statement("UPDATE applications SET paket = ELT(FLOOR(1 + RAND() * 4), 'Базовый', 'Про', 'Стандарт', 'Продвинутая') WHERE paket IS NULL");
        } else {
            foreach (DB::table('applications')->whereNull('paket')->pluck('id') as $id) {
                DB::table('applications')->where('id', $id)->update([
                    'paket' => ['Базовый', 'Про', 'Стандарт', 'Продвинутая'][random_int(0, 3)]
                ]);
            }
        }
    }

    public function down()
    {
        //
    }
};
