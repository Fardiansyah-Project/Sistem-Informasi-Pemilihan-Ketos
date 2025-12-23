<?php

namespace Database\Seeders;

use App\Models\Candidate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $candidates = [
            [
                'name' => 'Andi Wijaya',
                'candidate_number' => '01',
                'vision_mission' => 'Visi: Menjadikan OSIS yang inovatif. Misi: Mengadakan kegiatan seni dan olahraga rutin.',
                'photo' => 'candidate1.jpg'
            ],
            [
                'name' => 'Siti Aminah',
                'candidate_number' => '02',
                'vision_mission' => 'Visi: OSIS yang religius dan disiplin. Misi: Memperkuat literasi dan karakter siswa.',
                'photo' => 'candidate2.jpg'
            ],
            [
                'name' => 'Budi Santoso',
                'candidate_number' => '03',
                'vision_mission' => 'Visi: Digitalisasi OSIS. Misi: Membangun sistem administrasi sekolah berbasis web.',
                'photo' => 'candidate3.jpg'
            ],
        ];

        foreach ($candidates as $data) {
            Candidate::create($data);
        }
    }
}
