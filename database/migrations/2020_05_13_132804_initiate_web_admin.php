<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InitiateWebAdmin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    $admin = DB::table('roles')->where("guard_name", "=", "web")->where("name", "=", "Administrator")->first();
    if (!$admin) {
        DB::table("roles")->insert([
            "name" => "Administrator",
            "guard_name" => "web",
            "created_at" => now(),
            "updated_at" => now(),
        ]);
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
