<?php

use System\Core\Database\Builder;
use System\Core\Database\Schema;

class User
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create(function (Builder $table) {
            $table->create_table('users', true, [
                'id' => 'INT(11) NOT NULL',
                'name' => 'VARCHAR(255) NOT NULL',
                'password' => 'VARCHAR(255) NOT NULL'
            ])->add_key('id', true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop("users");
    }
}
