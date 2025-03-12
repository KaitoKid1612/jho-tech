<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $tasks = DB::table('tasks')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();

        foreach ($tasks as $taskId) {
            DB::table('task_tags')->insert([
                'task_id' => $taskId,
                'tag_id' => $tags[array_rand($tags)],
            ]);
        }
    }
}
