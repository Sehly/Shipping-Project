<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('governorate_id')->nullable();
            $table->foreign('governorate_id')->references('id')->on('governorates')->onDelete('set null');
            $table->decimal('company_per', 5, 2)->nullable();
            $table->boolean('status')->default(true);
            $table->enum('discount_type', ['5%', '10%', '15%'])->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['governorate_id']);
            $table->dropColumn(['governorate_id', 'company_per', 'status', 'discount_type']);
        });
    }
}
