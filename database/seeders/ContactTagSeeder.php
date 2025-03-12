<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContactTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $contacts = DB::table('contacts')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();

        foreach ($contacts as $contactId) {
            DB::table('contact_tags')->insert([
                'contact_id' => $contactId,
                'tag_id' => $tags[array_rand($tags)],
            ]);
        }
    }
}
