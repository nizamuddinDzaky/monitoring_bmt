<?php

namespace Database\Seeders;

use App\Models\Footer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Footer::truncate();
        DB::insert("INSERT INTO `footer` VALUES (1, 'images/headline/1615517739-bmt_logo.jpg', '<p><b>Tanggal Pendirian</b></p><p>30 Januari 2012</p><p><b>No &amp; Tanggal Pendirian</b></p><p>No 44 Tanggal 30 Januari 2021</p><p><b>No &amp; Tanggal Legal Entity</b></p><p>No BH/P2T/10/09.01/01/V/2012 8th Mei 2012</p>', '<p>Head Office : Jalan Kedinding Lor Gang Tanjung 49<br>Kelurahan Tanah Kali Kedinding, Kecamatan Kenjeran<br>Kota Surabaya<br>Branch Office: Jl.Raya Bungah No.18, Gresik<br><b>Phone</b>: 031-3719610/0858-5081-9919</p>', NULL, '2021-03-12 09:55:39');");
    }
}
