<?php

class testSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $db = new Database();
        $db->insert("INSERT INTO USERS(name, password) VALUES('sikder', '123')");
    }
}
