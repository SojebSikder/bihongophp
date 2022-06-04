<?php

use System\Core\Database\Builder;
use System\Core\Database\Schema;

class Data
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
            $table->create_table("datas", true, [
                "id" => "INT(11) NOT NULL",
                "title" => "VARCHAR(255) NULL",
                "text" => "VARCHAR(255) NULL",
            ])->add_key("id", true);
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
        Schema::drop("datas");
    }
}
