<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GiveAdminOnFirstWebUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $user = \App\User::first();
        $user->roles()->sync(\Spatie\Permission\Models\Role::query()->where("name","=","Administrator")->where("guard_name", "=", "web")->get()->pluck('id'));

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
