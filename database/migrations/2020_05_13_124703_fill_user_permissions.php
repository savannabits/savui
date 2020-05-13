<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FillUserPermissions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $perms = ["user", "user.index", "user.create", "user.show", "user.edit", "user.delete", "user.bulk-delete"];
        $roles = ["Administrator", "System Admin"];
        \App\Repos\Permissions::seedPermissions($perms,"web", $roles);
        $perms = ["admin.user", "admin.user.index", "admin.user.create", "admin.user.show", "admin.user.edit", "admin.user.delete", "admin.user.bulk-delete"];
        \App\Repos\Permissions::seedPermissions($perms, "admin", $roles);
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
