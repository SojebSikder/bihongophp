<?php

class Test
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(function(Builder $table){
			$table->create_table('sojebsikder', false,[
				'id' => 'INT(11) NOT NULL',
				'title' => 'VARCHAR(200) NOT NULL'
			]);
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('sojebsikder');
    }
}
