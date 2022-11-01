<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //  \App\Models\User::factory(5)->create();
        $user = User::factory()->create([
            'name' => 'john Doe',
            'email' => 'john@gmail.com'
        ]);
         Listing::factory(6)->create([
            'user_id' => $user->id
         ]);

        // Listing::create([
        //     'title' => 'Laravel Senior Developer',
        //     'tags' => 'Laravel, Javascript',
        //     'company' => 'Acme Corp',
        //     'location' => 'Abuja Lagos',
        //     'email'=> 'test@email.com',
        //     'website' => 'https://www.acme.com',
        //     'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus voluptates ad, ea hic quod accusantium unde necessitatibus! Repellendus, vitae id'
        // ]);


        // Listing::create([
        //     'title' => 'Full-stack Engineer',
        //     'tags' => 'Laravel,backend api',
        //     'company' => 'Acme Corp',
        //     'location' => 'Abuja Lagos',
        //     'email'=> 'test2@email.com',
        //     'website' => 'https://www.stack.com',
        //     'description' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Delectus voluptates ad, ea hic quod accusantium unde necessitatibus! Repellendus, vitae id'
        // ]);
    }
}
