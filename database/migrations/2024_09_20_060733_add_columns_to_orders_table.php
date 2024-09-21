<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('orderType', ['branch', 'company', 'specific place']);
            $table->string('clientName');
            $table->string('phone1');
            $table->string('email');
            $table->string('village');
            $table->string('toVillage');
            $table->enum('shippingType', ['regular', 'in 24hours', '2 weeks']);
            $table->enum('paymentType', ['cash', 'visa']);
            $table->text('notes');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'orderType',
                'clientName',
                'phone1',
                'email',
                'village',
                'toVillage',
                'shippingType',
                'paymentType',
                'notes',
            ]);
        });
    }
};
