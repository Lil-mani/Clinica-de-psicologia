<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientRecord extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'email', 'profession', 'marital_status', 'spouse_name', 'spouse_age', 'spouse_profession',
        'spouse_education', 'main_complaint', 'previous_therapy', 'patient_expectations', 'presented_symptoms',
        'physical_diseases', 'psychosocial_stressors', 'global_functioning', 'psychological_conceptualization',
        'previous_psychiatric_disorders', 'family_psychiatric_disorders', 'significant_diseases', 'current_medication',
        'alternative_medication', 'test_application', 'complaint_start', 'traumatic_events', 'crisis_factors',
        'drug_use', 'suicide_attempt', 'therapeutic_focus', 'pregnancy', 'childbirth', 'breastfeeding',
        'hygiene_training', 'childhood_stressors', 'childhood_disorders', 'other_comments', 'affectionate_experiences',
        'sexual_experiences', 'first_jobs', 'friendship_circles', 'partner_relationships', 'current_sex_life',
        'financial_situation', 'abortions', 'social_support', 'current_disorders', 'main_leisure_activities',
        'social_life', 'general_observation', 'non_verbal_language', 'professional', 'referrals_made', 'therapeutics_used'
    ];

}
