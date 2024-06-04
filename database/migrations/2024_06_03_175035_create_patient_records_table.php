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
        Schema::create('patient_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('profession')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('spouse_age')->nullable();
            $table->string('spouse_profession')->nullable();
            $table->string('spouse_education')->nullable();
            $table->text('main_complaint')->nullable();
            $table->text('previous_therapy')->nullable();
            $table->text('patient_expectations')->nullable();
            $table->text('presented_symptoms')->nullable();
            $table->text('physical_diseases')->nullable();
            $table->text('psychosocial_stressors')->nullable();
            $table->text('global_functioning')->nullable();
            $table->text('psychological_conceptualization')->nullable();
            $table->text('previous_psychiatric_disorders')->nullable();
            $table->text('family_psychiatric_disorders')->nullable();
            $table->text('significant_diseases')->nullable();
            $table->text('current_medication')->nullable();
            $table->text('alternative_medication')->nullable();
            $table->text('test_application')->nullable();
            $table->text('complaint_start')->nullable();
            $table->text('traumatic_events')->nullable();
            $table->text('crisis_factors')->nullable();
            $table->text('drug_use')->nullable();
            $table->text('suicide_attempt')->nullable();
            $table->text('therapeutic_focus')->nullable();
            $table->text('pregnancy')->nullable();
            $table->text('childbirth')->nullable();
            $table->text('breastfeeding')->nullable();
            $table->text('hygiene_training')->nullable();
            $table->text('childhood_stressors')->nullable();
            $table->text('childhood_disorders')->nullable();
            $table->text('other_comments')->nullable();
            $table->text('affectionate_experiences')->nullable();
            $table->text('sexual_experiences')->nullable();
            $table->text('first_jobs')->nullable();
            $table->text('friendship_circles')->nullable();
            $table->text('partner_relationships')->nullable();
            $table->text('current_sex_life')->nullable();
            $table->text('financial_situation')->nullable();
            $table->text('abortions')->nullable();
            $table->text('social_support')->nullable();
            $table->text('current_disorders')->nullable();
            $table->text('main_leisure_activities')->nullable();
            $table->text('social_life')->nullable();
            $table->text('general_observation')->nullable();
            $table->text('non_verbal_language')->nullable();
            $table->string('professional')->nullable();
            $table->text('referrals_made')->nullable();
            $table->text('therapeutics_used')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patient_records');
    }

};
