<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rejected_applicants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('applications_id')->constrained()->cascadeOnDelete();
            $table->foreignId('applicants_id')->constrained()->cascadeOnDelete();
            $table->foreignId('applicant_lists_id')->constrained()->cascadeOnDelete();
            $table->string('document');
            $table->string('added');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rejected_applicants');
    }
};
