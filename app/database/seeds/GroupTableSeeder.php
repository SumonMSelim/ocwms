<?php

class GroupTableSeeder extends Seeder
{
    public function run()
    {
        //delete groups table records
        DB::table('groups')->truncate();

        DB::table('groups')->insert([
            ['name'=>'superadmin'],
            ['name'=>'faculty'],
            ['name'=>'student'],
        ]);
    }
} 