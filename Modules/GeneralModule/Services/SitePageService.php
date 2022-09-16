<?php


namespace Modules\GeneralModule\Services;


use Modules\GeneralModule\Entities\SiteManager;
use function PHPUnit\Framework\isEmpty;

class SitePageService
{
    private $sitePageManager;

    public function __construct(SiteManager $siteManager)
    {
        $this->sitePageManager = $siteManager;
    }

    public function getSitePageContent()
    {
        return $this->sitePageManager->first();
    }

    public function saveSiteContentByPage($data)
    {
        if (empty($this->getSitePageContent())) {
            //first time of adding, site content
            return $this->sitePageManager->create($data);
        } else {
            return $this->sitePageManager->find(1)->update($data);
        }
    }
}
