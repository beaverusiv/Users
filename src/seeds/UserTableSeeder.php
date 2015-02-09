<?php namespace Bocapa\Users\Seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        // If we're truncating users we need to do the
        // - same to the pivot table.
        if(Schema::hasTable('group_user')) {
            DB::table('group_user')->delete();
        }

        User::create(array(
            'email' => 'nic@bocapa.com',
            'name' => 'Nic Loomans',
            'password' => Hash::make('bvaworld')
        ));
    }

}