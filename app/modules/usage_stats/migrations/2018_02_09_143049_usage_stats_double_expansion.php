<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class UsageStatsDoubleExpansion extends Migration
{
    public function up()
    {
        $capsule = new Capsule();
        $capsule::schema()->table('usage_stats', function (Blueprint $table) {
            $table->double('ibyte_rate',16,2)->nullable();
            $table->double('ibytes',16,2)->nullable();
            $table->double('ipacket_rate',16,2)->nullable();
            $table->double('ipackets',16,2)->nullable();
            $table->double('obyte_rate',16,2)->nullable();
            $table->double('obytes',16,2)->nullable();
            $table->double('opacket_rate',16,2)->nullable();
            $table->double('opackets',16,2)->nullable();
            $table->double('rbytes_per_s',16,2)->nullable();
            $table->double('rops_per_s',16,2)->nullable();
            $table->double('wbytes_per_s',16,2)->nullable();
            $table->double('wops_per_s',16,2)->nullable();
            $table->double('rbytes_diff',16,2)->nullable();
            $table->double('rops_diff',16,2)->nullable();
            $table->double('wbytes_diff',16,2)->nullable();
            $table->double('wops_diff',16,2)->nullable();
            $table->double('package_watts',16,2)->nullable();
            $table->double('package_joules',16,2)->nullable();
            $table->double('freq_hz',16,2)->nullable(); // CPU
            $table->double('freq_ratio',16,2)->nullable(); // CPU
            $table->double('gpu_freq_hz',16,2)->nullable();
            $table->double('gpu_freq_mhz',16,2)->nullable();
            $table->double('gpu_freq_ratio',16,2)->nullable();
            $table->double('gpu_busy',16,2)->nullable();
        });
    }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->dropIfExists('usage_stats');
    }
}
