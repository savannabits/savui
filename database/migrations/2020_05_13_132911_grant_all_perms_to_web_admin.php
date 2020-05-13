<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class GrantAllPermsToWebAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**@var \Spatie\Permission\Models\Role $admin*/
        $admin = \Spatie\Permission\Models\Role::query()->where("name", "=", "Administrator")->where("guard_name", "=","web")->first();
        if ($admin) {
            $perms = DB::table('permissions')->where("guard_name", "=", "web")->get()->pluck('id');
            $admin->permissions()->sync($perms);
        }
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
