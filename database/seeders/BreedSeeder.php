<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BreedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Breed::create([
            'name' => 'No Breed / Unidentified',
            'description' => 'Its just a bag of love and hair :D',
        ]);

        \App\Models\Breed::create([
            'name' => 'American Curl Cat Breed',
            'description' => 'With unique ears that curl back, and an inquisitive expression reminiscent of happy surprise, the American Curl brings a smile to everyone who meets her.',
        ]);

        \App\Models\Breed::create([
            'name' => 'American Shorthair  Cat Breed',
            'description' => 'Formerly used to keep rodents and vermin away from food stores, the American Shorthair still enjoys exercising her hunting skills on unsuspecting insects.',
        ]);

        \App\Models\Breed::create([
            'name' => 'Bombay Cat',
            'description' => 'The Bombay is an easy-going, yet energetic cat. She does well in quiet apartments where she’s the center of attention as well as in lively homes with children and other pets.',
        ]);

        \App\Models\Breed::create([
            'name' => 'Egyptian Mau Cat',
            'description' => 'The Egyptian Mau is fiercely devoted to her humans and vocally shows signs of happiness and affection by meowing in a pleasant voice. She’ll also slowly swish her tail and knead with her front paws.',
        ]);

        \App\Models\Breed::create([
            'name' => 'Persian Cat Breed',
            'description' => 'The docile Persian is a quiet feline who enjoys a calm and relaxing environment. Although she enjoys sitting in her humans’ laps and being pet, she’s just as happy to sit and observe everyone’s comings and goings from afar.',
        ]);

        \App\Models\Breed::create([
            'name' => 'Siamese Cat Breed',
            'description' => 'Siamese Cats are incredibly social, intelligent and vocal—they’ll talk to anyone who wants to listen, and even those who don’t. They also play well with other cats, dogs and children.',
        ]);

        \App\Models\Breed::create([
            'name' => 'Turkish Van Cat Breed',
            'description' => 'The beautiful Turkish Van is distinguished by her chalk-white body and colored markings on the head and long, plumed tail. This curious feline has powerful hind legs that allow her to jump on otherwise hard-to-reach spaces.',
        ]);
    }
}
