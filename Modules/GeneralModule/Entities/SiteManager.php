<?php

namespace Modules\GeneralModule\Entities;

use Illuminate\Database\Eloquent\Model;

class SiteManager extends Model
{
    protected $table = "site_pages";
    protected $fillable = ['about_page', 'help_center', 'policy_page', 'report_page', 'disclaimer_page'];

}
