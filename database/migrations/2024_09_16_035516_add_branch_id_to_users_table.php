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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('branch_id')->nullable(); // Foreign key column
    
            // Add foreign key constraint
            $table->foreign('branch_id')->references('id')->on('branches');
        });
    }
    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['branch_id']); // Drop foreign key constraint
            $table->dropColumn('branch_id'); // Drop the column
        });
    }
    
};
