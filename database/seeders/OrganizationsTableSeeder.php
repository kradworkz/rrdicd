<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrganizationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('organizations')->delete();
        
        \DB::table('organizations')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Andres Bonifacio College',
                'acronym' => 'ABC',
                'email' => 'info@abcollege.edu.ph',
            'mobile_no' => '(065) 212-4884',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:18:58',
                'updated_at' => '2021-08-17 01:18:58',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Ateneo De Zamboanga University',
                'acronym' => 'ADZU',
                'email' => 'president@adzu.edu.ph',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:21:14',
                'updated_at' => '2021-08-17 01:21:14',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Bureau Of Fisheries And Aquatic Resources Ix',
                'acronym' => 'BFAR',
                'email' => 'bfar.region9@gmail.com',
                'mobile_no' => '991-8192',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:23:28',
                'updated_at' => '2021-08-17 01:23:28',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Brent Hospital And Colleges Incorporated',
                'acronym' => 'BRENT',
                'email' => 'brentexecutivesec@yahoo.com',
            'mobile_no' => '(062) 991 2990',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:24:49',
                'updated_at' => '2021-08-17 01:24:49',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Basilan State University',
                'acronym' => 'BSU',
                'email' => 'basilanstatecollege1984@gmail.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:25:19',
                'updated_at' => '2021-08-17 01:25:19',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Department Of Agriculture Ix',
                'acronym' => 'DA-IX',
                'email' => 'zamboanga@mail.da.gov.ph',
                'mobile_no' => '991-2594',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:28:12',
                'updated_at' => '2021-08-17 01:28:12',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Jh Cerilles State College- Main',
                'acronym' => 'JHCSC-M',
                'email' => 'ovpre@jhcsc.edu.ph',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:29:08',
                'updated_at' => '2021-08-17 01:29:08',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Jose Rizal Memorial State University',
                'acronym' => 'JRMSU',
                'email' => 'vprde@jrmsu.edu.ph',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:29:45',
                'updated_at' => '2021-08-17 01:29:45',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Mindanao State University - Buug Campus',
                'acronym' => 'MSU-BUUG',
                'email' => 'msubuugcampus@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:31:57',
                'updated_at' => '2021-08-17 01:31:57',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Pilar College Of Zamboanga, Inc.',
                'acronym' => 'PCZ',
                'email' => 'pilarcollegezc@gmail.com',
            'mobile_no' => '(062) 991 5410',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:33:08',
                'updated_at' => '2021-08-17 01:33:08',
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'Universidad De Zamboanga',
                'acronym' => 'UZ',
                'email' => 'universidaddezamboanga@uz.edu.ph',
                'mobile_no' => '991-1135',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:33:57',
                'updated_at' => '2021-08-17 01:33:57',
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'Western Mindanao State University',
                'acronym' => 'WMSU',
                'email' => 'wmsu@wmsu.edu.ph',
                'mobile_no' => '992-4238',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:34:33',
                'updated_at' => '2021-08-17 01:34:33',
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'Western Mindanao Agriculture And Aquatic Resources Research And Development Consortium',
                'acronym' => 'WESMAARRDEC',
                'email' => 'wesmaarrdec@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:36:36',
                'updated_at' => '2021-08-17 01:36:36',
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'Zamboanga-basilan Integrated Development Alliance Inc',
                'acronym' => 'ZB - IDA',
                'email' => 'zabidamail.ph@gmail.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:41:47',
                'updated_at' => '2021-08-17 01:41:47',
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'Zamboanga Peninsula Polytechnic State University',
                'acronym' => 'ZPPSU',
                'email' => 'zcspc@zcspc.edu.ph',
                'mobile_no' => '991-3815',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:42:56',
                'updated_at' => '2021-08-17 01:42:56',
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'Zamboanga State College Of Marine Sciences And Technology/ Zamboanga City Food Innovation Center',
                'acronym' => 'ZSCMST',
                'email' => 'pres@zscmst.edu.ph',
            'mobile_no' => '(062) 992-3092',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:43:59',
                'updated_at' => '2021-08-17 01:43:59',
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'Zamboanga Peninsula Food Innovation Center',
                'acronym' => 'ZAMPEN - FIC',
                'email' => 'zampenfic@gmail.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:45:02',
                'updated_at' => '2021-08-17 01:45:02',
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'Department Of Health Ix',
                'acronym' => 'DOH - IX',
                'email' => 'dohchdzp@yahoo.com',
            'mobile_no' => '(062) 992-2745',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:45:56',
                'updated_at' => '2021-08-17 01:45:56',
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'Philippine Coconut Authority Zamboanga Research Center',
                'acronym' => 'PCAZRC',
                'email' => 'pcazrc@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:48:02',
                'updated_at' => '2021-08-17 01:48:02',
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'Andres Bonifacio College Innovation Center For Agriculture',
                'acronym' => 'ABC - ICA',
                'email' => 'abc@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 3,
                'created_at' => '2021-08-17 01:49:26',
                'updated_at' => '2021-08-17 01:49:26',
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'Department Of Science And Technology',
                'acronym' => 'DOST',
                'email' => 'temp1@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:24:25',
                'updated_at' => '2021-07-09 10:24:25',
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'Department Of Health - Zamboanga Peninsula Center For Health Development',
                'acronym' => 'DOH-ZOCHD',
                'email' => 'temp2@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:25:30',
                'updated_at' => '2021-07-09 10:25:30',
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'National Fisheries Research And Development Institute',
                'acronym' => 'NFRDI',
                'email' => 'temp3@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:25:54',
                'updated_at' => '2021-07-09 10:25:54',
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'Bureau Of Fisheries And Aquatic Resources',
                'acronym' => 'BFAR',
                'email' => 'temp4@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:27:34',
                'updated_at' => '2021-07-09 10:27:34',
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'DOST - Philippine Council For Agriculture, Aquatic And Natural Resources Research And Development',
                'acronym' => 'DOST-PCAARRD',
                'email' => 'temp5@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:29:20',
                'updated_at' => '2021-07-09 10:30:14',
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'Department Of Agriculture Bureau Of Agricultural Research',
                'acronym' => 'DA-BAR',
                'email' => 'temp6@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:31:09',
                'updated_at' => '2021-07-09 10:31:09',
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'DOST - Philippine Council For Health Research And Development Regional Research Fund',
                'acronym' => 'DOST-PCHRD RRF',
                'email' => 'temp7@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:33:08',
                'updated_at' => '2021-07-09 10:33:08',
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'Commission On Higher Education',
                'acronym' => 'CHED',
                'email' => 'temp8@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:33:42',
                'updated_at' => '2021-07-09 10:33:42',
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'Western Mindanao State University',
                'acronym' => 'WMSU - INSTITUTIONAL',
                'email' => 'temp9@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:34:01',
                'updated_at' => '2021-07-09 10:34:11',
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'Zamboanga City Medical Center',
                'acronym' => 'ZCMC',
                'email' => 'temp10@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:34:44',
                'updated_at' => '2021-07-09 10:34:44',
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'Universidad De Los Andes',
                'acronym' => 'UDLA',
                'email' => 'temp11@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:37:03',
                'updated_at' => '2021-07-09 10:37:03',
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'DOST - Philippine Council For Industry, Energy, And Emerging Technology Research And Development',
                'acronym' => 'DOST-PCIEERD',
                'email' => 'temp12@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:38:20',
                'updated_at' => '2021-07-09 10:38:20',
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'Komisyon Sa Wikang Filipino',
                'acronym' => 'KWF',
                'email' => 'temp13@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:38:46',
                'updated_at' => '2021-07-09 10:38:46',
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'Department Of Labor And Employment - IX',
                'acronym' => 'DOLE IX',
                'email' => 'temp14@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:39:19',
                'updated_at' => '2021-07-09 10:39:19',
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'DOST - Technology Application And Promotion Institute',
                'acronym' => 'DOST-TAPI',
                'email' => 'temp15@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:40:00',
                'updated_at' => '2021-07-09 10:40:00',
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'Social Action Ministry  Archdiocese Of Ipil, Zamboanga Sibugay',
                'acronym' => 'SAM - NGO',
                'email' => 'temp16@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:41:13',
                'updated_at' => '2021-07-09 10:41:13',
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'Asian Development Bank : Pacific Rim Innovation And Management Exponents',
                'acronym' => 'ADB - PRIMEX',
                'email' => 'temp17@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:41:53',
                'updated_at' => '2021-07-09 10:41:53',
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'Southeast Asian Fisheries Development Council/aquaculture Department',
                'acronym' => 'SEAFDEC/AQD',
                'email' => 'temp18@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:42:27',
                'updated_at' => '2021-07-09 10:42:27',
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'USAID-dai Protect Wildlife',
                'acronym' => 'USAID',
                'email' => 'temp19@yahoo.com',
                'mobile_no' => 'n/a',
                'avatar' => 'school.jpg',
                'type_id' => 4,
                'created_at' => '2021-07-09 10:43:32',
                'updated_at' => '2021-07-09 10:43:32',
            ),
        ));
        
        
    }
}