<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OpportunityTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $opportunities = DB::table('opportunities')->pluck('id')->toArray();
        $tags = DB::table('tags')->pluck('id')->toArray();

        foreach ($opportunities as $opportunityId) {
            DB::table('opportunity_tags')->insert([
                'opportunity_id' => $opportunityId,
                'tag_id' => $tags[array_rand($tags)],
            ]);
        }
    }
}
