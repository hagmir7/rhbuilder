<?php

namespace Database\Seeders;

use App\Models\Diploma;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Level;
use App\Models\Resume;
use App\Models\Skill;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear pivot tables first (safe for seeding)
        DB::table('resume_skills')->truncate();
        DB::table('resume_languages')->truncate();

        // Resume 1: Senior Developer
        $resume1 = Resume::create([
            'first_name' => 'Ahmed',
            'last_name' => 'El Mansouri',
            'email' => 'ahmed.mansouri@example.com',
            'phone' => '0612345678',
            'marital_status' => 1,
            'birth_date' => '1990-05-15',
            'gender' => 1,
            'cin' => 'AB123456',
            'address' => '123 Rue de Fès, Casablanca',
            'city_id' => 2,
            'status' => 1,
            'user_id' => 1,
            'experience_month' => 36,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume1->id, [
            ['company' => 'Informatique Maroc', 'work_post' => 'Développeur Full Stack', 'start_date' => '2020-01-01', 'end_date' => '2023-06-30'],
            ['company' => 'DigitalTech Solutions', 'work_post' => 'Chef de Projet', 'start_date' => '2023-07-01', 'end_date' => null],
        ]);

        $this->addSkills($resume1->id, 3);
        $this->addDiplomas($resume1->id, [
            ['name' => 'Licence en Informatique', 'end_date' => '2017-06-30', 'institution' => 'Université Hassan II - Casablanca', 'private' => false],
            ['name' => 'Master en Génie Logiciel', 'end_date' => '2019-06-30', 'institution' => 'Université Mohammed V - Rabat', 'private' => true],
        ]);
        $this->addLanguages($resume1->id);

        // Resume 2: Marketing Manager
        $resume2 = Resume::create([
            'first_name' => 'Fatima',
            'last_name' => 'Benali',
            'email' => 'fatima.benali@example.com',
            'phone' => '0623456789',
            'marital_status' => 2,
            'birth_date' => '1988-03-22',
            'gender' => 1,
            'cin' => 'CD789012',
            'address' => '45 Avenue Mohammed V, Rabat',
            'city_id' => 1,
            'status' => 1,
            'user_id' => 2,
            'experience_month' => 48,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume2->id, [
            ['company' => 'Agence Créative Plus', 'work_post' => 'Chargée de Marketing', 'start_date' => '2019-03-01', 'end_date' => '2021-12-31'],
            ['company' => 'MarketPro Agency', 'work_post' => 'Responsable Marketing Digital', 'start_date' => '2022-01-15', 'end_date' => null],
        ]);

        $this->addSkills($resume2->id, 4);
        $this->addDiplomas($resume2->id, [
            ['name' => 'Master en Marketing', 'end_date' => '2018-07-15', 'institution' => 'ENCG Rabat', 'private' => false],
        ]);
        $this->addLanguages($resume2->id);

        // Resume 3: Junior Designer
        $resume3 = Resume::create([
            'first_name' => 'Youssef',
            'last_name' => 'Alami',
            'email' => 'youssef.alami@example.com',
            'phone' => '0634567890',
            'marital_status' => 1,
            'birth_date' => '1995-09-10',
            'gender' => 1,
            'cin' => 'EF345678',
            'address' => '78 Rue des Arts, Marrakech',
            'city_id' => 3,
            'status' => 1,
            'user_id' => 3,
            'experience_month' => 18,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume3->id, [
            ['company' => 'Studio Créatif', 'work_post' => 'Designer Graphique Junior', 'start_date' => '2022-06-01', 'end_date' => null],
        ]);

        $this->addSkills($resume3->id, 5);
        $this->addDiplomas($resume3->id, [
            ['name' => 'Diplôme en Design Graphique', 'end_date' => '2022-05-30', 'institution' => 'École Supérieure des Arts', 'private' => true],
        ]);
        $this->addLanguages($resume3->id);

        // Resume 4: Financial Analyst
        $resume4 = Resume::create([
            'first_name' => 'Khadija',
            'last_name' => 'Hamidi',
            'email' => 'khadija.hamidi@example.com',
            'phone' => '0645678901',
            'marital_status' => 1,
            'birth_date' => '1987-12-08',
            'gender' => 1,
            'cin' => 'GH901234',
            'address' => '156 Boulevard Zerktouni, Casablanca',
            'city_id' => 2,
            'status' => 1,
            'user_id' => 4,
            'experience_month' => 60,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume4->id, [
            ['company' => 'Banque Populaire', 'work_post' => 'Analyste Financier', 'start_date' => '2018-09-01', 'end_date' => '2021-08-31'],
            ['company' => 'BMCE Capital', 'work_post' => 'Senior Analyste Financier', 'start_date' => '2021-09-01', 'end_date' => null],
        ]);

        $this->addSkills($resume4->id, 3);
        $this->addDiplomas($resume4->id, [
            ['name' => 'Master en Finance', 'end_date' => '2018-06-30', 'institution' => 'ISCAE Casablanca', 'private' => false],
            ['name' => 'CFA Level II', 'end_date' => '2020-12-15', 'institution' => 'CFA Institute', 'private' => true],
        ]);
        $this->addLanguages($resume4->id);

        // Resume 5: HR Specialist
        $resume5 = Resume::create([
            'first_name' => 'Omar',
            'last_name' => 'Tazi',
            'email' => 'omar.tazi@example.com',
            'phone' => '0656789012',
            'marital_status' => 1,
            'birth_date' => '1991-07-25',
            'gender' => 1,
            'cin' => 'IJ567890',
            'address' => '89 Rue Allal Ben Abdellah, Fès',
            'city_id' => 4,
            'status' => 1,
            'user_id' => 5,
            'experience_month' => 30,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume5->id, [
            ['company' => 'ManpowerGroup Morocco', 'work_post' => 'Spécialiste RH', 'start_date' => '2021-02-01', 'end_date' => null],
        ]);

        $this->addSkills($resume5->id, 4);
        $this->addDiplomas($resume5->id, [
            ['name' => 'Master en Gestion des Ressources Humaines', 'end_date' => '2020-07-30', 'institution' => 'Université Sidi Mohamed Ben Abdellah', 'private' => false],
        ]);
        $this->addLanguages($resume5->id);

        // Resume 6: Sales Representative
        $resume6 = Resume::create([
            'first_name' => 'Aicha',
            'last_name' => 'Chakir',
            'email' => 'aicha.chakir@example.com',
            'phone' => '0667890123',
            'marital_status' => 2,
            'birth_date' => '1993-01-14',
            'gender' => 1,
            'cin' => 'KL123456',
            'address' => '34 Avenue Hassan II, Agadir',
            'city_id' => 5,
            'status' => 1,
            'user_id' => 6,
            'experience_month' => 24,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume6->id, [
            ['company' => 'TechSales Morocco', 'work_post' => 'Représentante Commerciale', 'start_date' => '2022-03-01', 'end_date' => null],
        ]);

        $this->addSkills($resume6->id, 3);
        $this->addDiplomas($resume6->id, [
            ['name' => 'Licence en Commerce', 'end_date' => '2021-06-30', 'institution' => 'Université Ibn Zohr', 'private' => false],
        ]);
        $this->addLanguages($resume6->id);

        // Resume 7: Software Engineer
        $resume7 = Resume::create([
            'first_name' => 'Mehdi',
            'last_name' => 'Berrada',
            'email' => 'mehdi.berrada@example.com',
            'phone' => '0678901234',
            'marital_status' => 1,
            'birth_date' => '1994-11-03',
            'gender' => 1,
            'cin' => 'MN789012',
            'address' => '67 Rue de la Liberté, Tanger',
            'city_id' => 6,
            'status' => 1,
            'user_id' => 7,
            'experience_month' => 20,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume7->id, [
            ['company' => 'Innovative Software', 'work_post' => 'Ingénieur Logiciel', 'start_date' => '2022-08-01', 'end_date' => null],
        ]);

        $this->addSkills($resume7->id, 6);
        $this->addDiplomas($resume7->id, [
            ['name' => 'Diplôme d\'Ingénieur en Informatique', 'end_date' => '2022-06-30', 'institution' => 'ENSIAS Rabat', 'private' => false],
        ]);
        $this->addLanguages($resume7->id);

        // Resume 8: Project Manager
        $resume8 = Resume::create([
            'first_name' => 'Samira',
            'last_name' => 'El Fassi',
            'email' => 'samira.elfassi@example.com',
            'phone' => '0689012345',
            'marital_status' => 1,
            'birth_date' => '1986-04-18',
            'gender' => 1,
            'cin' => 'OP345678',
            'address' => '92 Boulevard Mohammed VI, Oujda',
            'city_id' => 7,
            'status' => 1,
            'user_id' => 8,
            'experience_month' => 72,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume8->id, [
            ['company' => 'Construction Plus', 'work_post' => 'Chef de Projet Junior', 'start_date' => '2018-01-01', 'end_date' => '2020-12-31'],
            ['company' => 'Mega Projects SA', 'work_post' => 'Chef de Projet Senior', 'start_date' => '2021-01-01', 'end_date' => null],
        ]);

        $this->addSkills($resume8->id, 4);
        $this->addDiplomas($resume8->id, [
            ['name' => 'Master en Gestion de Projets', 'end_date' => '2017-07-30', 'institution' => 'Université Mohammed Premier', 'private' => false],
            ['name' => 'Certification PMP', 'end_date' => '2019-03-15', 'institution' => 'PMI', 'private' => true],
        ]);
        $this->addLanguages($resume8->id);

        // Resume 9: Data Analyst
        $resume9 = Resume::create([
            'first_name' => 'Rachid',
            'last_name' => 'Amrani',
            'email' => 'rachid.amrani@example.com',
            'phone' => '0690123456',
            'marital_status' => 1,
            'birth_date' => '1992-08-30',
            'gender' => 1,
            'cin' => 'QR901234',
            'address' => '145 Avenue Lalla Yacout, Casablanca',
            'city_id' => 2,
            'status' => 1,
            'user_id' => 9,
            'experience_month' => 28,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume9->id, [
            ['company' => 'DataTech Solutions', 'work_post' => 'Analyste de Données', 'start_date' => '2021-10-01', 'end_date' => null],
        ]);

        $this->addSkills($resume9->id, 5);
        $this->addDiplomas($resume9->id, [
            ['name' => 'Master en Data Science', 'end_date' => '2021-06-30', 'institution' => 'Université Hassan II - Casablanca', 'private' => false],
        ]);
        $this->addLanguages($resume9->id);

        // Resume 10: Content Writer
        $resume10 = Resume::create([
            'first_name' => 'Laila',
            'last_name' => 'Bennani',
            'email' => 'laila.bennani@example.com',
            'phone' => '0601234567',
            'marital_status' => 1,
            'birth_date' => '1996-02-12',
            'gender' => 1,
            'cin' => 'ST567890',
            'address' => '23 Rue Ibn Sina, Meknes',
            'city_id' => 8,
            'status' => 1,
            'user_id' => 1,
            'experience_month' => 12,
            'nationality' => 'Marocaine',
        ]);

        $this->addExperiences($resume10->id, [
            ['company' => 'Digital Content Agency', 'work_post' => 'Rédactrice de Contenu', 'start_date' => '2023-01-01', 'end_date' => null],
        ]);

        $this->addSkills($resume10->id, 4);
        $this->addDiplomas($resume10->id, [
            ['name' => 'Licence en Littérature Française', 'end_date' => '2022-06-30', 'institution' => 'Université Moulay Ismail', 'private' => false],
        ]);
        $this->addLanguages($resume10->id);
    }

    /**
     * Add experiences to a resume
     */
    private function addExperiences($resumeId, $experiences)
    {
        foreach ($experiences as $exp) {
            Experience::create([
                'resume_id' => $resumeId,
                'company' => $exp['company'],
                'work_post' => $exp['work_post'],
                'start_date' => $exp['start_date'],
                'end_date' => $exp['end_date'],
            ]);
        }
    }

    /**
     * Add random skills to a resume (SQL Server Compatible)
     */
    private function addSkills($resumeId, $count = 3)
    {
        $skills = Skill::inRandomOrder()->take($count)->pluck('id');
        
        foreach ($skills as $skillId) {
            // Use insert instead of insertOrIgnore for SQL Server
            try {
                DB::table('resume_skills')->insert([
                    'resume_id' => $resumeId,
                    'skill_id' => $skillId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            } catch (\Exception $e) {
                // Ignore duplicate key errors
                continue;
            }
        }
    }

    /**
     * Add diplomas to a resume
     */
    private function addDiplomas($resumeId, $diplomas)
    {
        $levels = Level::inRandomOrder()->get();
        
        foreach ($diplomas as $index => $diploma) {
            Diploma::create([
                'resume_id' => $resumeId,
                'name' => $diploma['name'],
                'end_date' => $diploma['end_date'],
                'level_id' => $levels[$index % $levels->count()]->id,
                'institution' => $diploma['institution'],
                'private' => $diploma['private'],
            ]);
        }
    }

    /**
     * Add random languages to a resume (SQL Server Compatible)
     */
    private function addLanguages($resumeId)
    {
        $languages = Language::pluck('id')->toArray();
        
        if (!empty($languages)) {
            $randomLanguages = collect($languages)->random(rand(1, min(3, count($languages))));
            
            foreach ($randomLanguages as $languageId) {
                // updateOrInsert is SQL Server compatible
                DB::table('resume_languages')->updateOrInsert(
                    [
                        'resume_id' => $resumeId,
                        'language_id' => $languageId,
                    ],
                    [
                        'level' => rand(1, 6),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}