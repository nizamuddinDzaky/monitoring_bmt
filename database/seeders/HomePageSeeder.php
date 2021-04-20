<?php

namespace Database\Seeders;

use App\Models\HomePage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HomePageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomePage::truncate();
        // DB::table('kabkot')->delete();
        DB::insert("INSERT INTO `homepage` VALUES (1, 'images/headline/1615517725-bmt_logo.jpg', 'BMT MUDA', 'Baitul Maal Wat Tamwil Mandiri Ukhuwah Persada', '<p>Jalan Kedinding Lor Gang Tanjung 49<br>Kelurahan Tanah Kali Kedinding, Kecamatan Kenjeran<br>Kota Surabaya<b><br>Phone : </b>(031) 371 9610 / 0858-5081-9919</p>', '<p><span style=\"caret-color: rgb(51, 51, 51); color: rgb(51, 51, 51);\">Berdaya, Mandiri, Sejahtera</span><br></p>', '<p style=\"margin-bottom: 0px; font-stretch: normal; line-height: normal; font-family: \" helvetica=\"\" neue\";\"=\"\"><span style=\"caret-color: rgb(51, 51, 51); color: rgb(51, 51, 51); font-family: \" open=\"\" sans\",=\"\" sans-serif;=\"\" text-align:=\"\" center;\"=\"\">Menjadi BMT yang terdepan, profesional dan dapat memberikan manfaat bagi masyarakat Surabaya pada khususnya dan Jawa Timur pada umumnya</span><br></p>', '<p><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"caret-color: rgb(51, 51, 51);\">Memberikan layanan keuangan berbasis syariah, profesional, terpecaya, dan akuntabel.</span></font></p><p><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"caret-color: rgb(51, 51, 51);\">Meningkatkan kualitas tenaga profesional dan memahami betul aspek BMT.</span></font></p><p><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"caret-color: rgb(51, 51, 51);\">Meningkatkan kinerja BMT dengan sistem berbasis teknologi informasi.</span></font></p><p><font color=\"#333333\" face=\"Open Sans, sans-serif\"><span style=\"caret-color: rgb(51, 51, 51);\">Menjunjung tiggi konsistensi prinsip syariah dalam operasional BMT.</span></font></p>', NULL, NULL, NULL, NULL, '2021-03-12 09:55:25');");
    }
}
