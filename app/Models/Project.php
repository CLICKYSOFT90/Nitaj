<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $with = ['projectFunding', 'projectDocuments',
        'projectImages', 'projectSponsors', 'projectCompany',
        'projectCountry', 'projectCities'];

    public function projectFunding()
    {
        return $this->hasOne(ProjectFundings::class);
    }
    public function projectDocuments()
    {
        return $this->hasMany(ProjectDocuments::class);
    }
    public function projectImages()
    {
        return $this->hasMany(ProjectImages::class);
    }
    public function projectSponsors()
    {
        return $this->hasMany(ProjectSponsors::class);
    }
    public function projectCompany()
    {
        return $this->hasOne(Company::class,'id', 'company_id');
    }
    public function projectCountry()
    {
        return $this->hasOne(Countries::class,'id', 'country');
    }
    public function projectCities()
    {
        return $this->hasOne(Cities::class,'id', 'city');
    }
    public function projectCampaign()
    {
        return $this->hasOne(FundingCampaigns::class);
    }
    public function fundingCampaigns(){
        return $this->hasOne(FundingCampaigns::class)->where('status', 1);
    }
    public function reports(){
        return $this->hasMany(Report::class, 'project_id', 'id')->with('reportDocuments','reportProgress', 'reportProgressSummary');
    }
}
