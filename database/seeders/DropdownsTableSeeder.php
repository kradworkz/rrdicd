<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DropdownsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('dropdowns')->delete();
        
        \DB::table('dropdowns')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'n/a',
                'type' => 'n/a',
                'classification' => 'n/a',
                'color' => 'n/a',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Committee Member',
                'type' => 'n/a',
                'classification' => 'Organization',
                'color' => 'n/a',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Monitoring Agency',
                'type' => 'n/a',
                'classification' => 'Organization',
                'color' => 'n/a',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Funding Agency',
                'type' => 'n/a',
                'classification' => 'Organization',
                'color' => 'n/a',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Pending',
                'type' => 'Research Status',
                'classification' => 'Status',
                'color' => 'yellow',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ongoing',
                'type' => 'Research Status',
                'classification' => 'Status',
                'color' => 'blue',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Completed',
                'type' => 'Research Status',
                'classification' => 'Status',
                'color' => 'green',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Operational',
                'type' => 'Research Status',
                'classification' => 'Status',
                'color' => 'info',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Declined',
                'type' => 'Research Status',
                'classification' => 'Status',
                'color' => 'danger',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'With IPR',
                'type' => 'IPR Status',
                'classification' => 'Status',
                'color' => 'green',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Without IPR',
                'type' => 'IPR Status',
                'classification' => 'Status',
                'color' => 'green',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'On Process IPR',
                'type' => 'IPR Status',
                'classification' => 'Status',
                'color' => 'green',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Capacities',
                'type' => 'n/a',
                'classification' => 'Classifications',
                'color' => 'n/a',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Knowledge-based',
                'type' => 'n/a',
                'classification' => 'Classifications',
                'color' => 'n/a',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Technology',
                'type' => 'n/a',
                'classification' => 'Classifications',
                'color' => 'n/a',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Engineering And Technology',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Social Sciences',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Medical And Health Sciences',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Agricultural Sciences',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Natural Sciences',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Humanities',
                'type' => 'n/a',
                'classification' => 'Specialties',
                'color' => 'n/a',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Intructor I',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'Instructor II',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Instructor III',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'Professor I',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Professor II',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'Professor III',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Professor IV',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Professor V',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Associate Professor I',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Associate Professor II',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'Associate Professor III',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Associate Professor IV',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Associate Professor V',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'Assistant Professor I',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Assistant Professor II',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Assistant Professor III',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Assistant Professor IV',
                'type' => 'n/a',
                'classification' => 'Designations',
                'color' => 'n/a',
            ),
        ));
        
        
    }
}