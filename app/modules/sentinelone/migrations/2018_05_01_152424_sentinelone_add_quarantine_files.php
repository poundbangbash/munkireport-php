<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class SentineloneAddQuarantineFiles extends Migration
{
    private $tableName = 'sentinelone';

    public function up()
    {
        $capsule = new Capsule();
        
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
              $table->string('uuid')->nullable()->change();
              $table->string('path')->nullable()->change();
        });
    }

    public function down()
    {
    $capsule = new Capsule();

        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('uuid');
            $table->dropColumn('path');
        });
        
    }
}
