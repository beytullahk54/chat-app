<?php

namespace App\Http\Controllers;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class VersionController extends Controller
{
    public function index($erisim = null)
    {
        ini_set('memory_limit', '1024M');
        if ($erisim == null) {
            return 'Erişiminiz yok';
        } elseif ($erisim == 'chat') {
            $this->version240824();
            
            //return "Toplam Öğrenci sayısı:".$nowDay." <br> Bugün eklenen öğrenci sayısı  ".$nowStudentCount." <br> Toplam Sertifika Verilen Katılımcı  version20201228 Veritabanı güncellemeleri başarılı";
            return "Güncelleme başarılı oldu";
        }
    }



    public function version240824()
    {
        if (!Schema::hasTable('rooms')) {
            Schema::create('rooms', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->nullable();
                $table->id('user_id')->nullable();
                $table->timestamps();
            });
        }
        if (!Schema::hasTable('user_rooms')) {
            Schema::create('user_rooms', function (Blueprint $table) {
                $table->increments('id');
                $table->foreignId('user_id');
                $table->foreignId('room_id');
                $table->timestamps();
            });
        }
    }


}
