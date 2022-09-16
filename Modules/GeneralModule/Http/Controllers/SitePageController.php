<?php


namespace Modules\GeneralModule\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\GeneralModule\Services\SitePageService;

class SitePageController extends Controller
{
    private $sitePageService;

    public function __construct(SitePageService $sitePageService)
    {
        $this->sitePageService = $sitePageService;
    }

    public function showManageSitePages()
    {
        $data['siteData'] = $this->sitePageService->getSitePageContent();
        return view('generalmodule::pages.manage_site_pages')->with($data);
    }

    public function showPageContent(Request $request)
    {
        $type = $request->get('type');
        $pages = $this->sitePageService->getSitePageContent();
        $data['pageContent'] = !empty($pages) ?$pages->$type : "";
        $data['pageTitle'] = strtoupper(str_replace('_'," ",$type));
        return view('generalmodule::site_page_content')->with($data);
    }

    public function saveSiteAboutPage(Request $request)
    {
        $content = $request->get('about_us');
        $data = array('about_page' => $content);
        $this->sitePageService->saveSiteContentByPage($data);
        session()->flash('success', trans('admin.save_site_save_success'));
        return redirect()->back()->with('success', trans('admin.save_site_save_success'));
    }

    public function saveSiteHelpCenterPage(Request $request)
    {
        $content = $request->get('help_center');
        $data = array('help_center' => $content);
        $this->sitePageService->saveSiteContentByPage($data);
        session()->flash('success', trans('admin.save_site_save_success'));
        return redirect()->back()->with('success', trans('admin.save_site_save_success'));
    }

    public function saveSitePolicyPage(Request $request)
    {
        $content = $request->get('policy_page');
        $data = array('policy_page' => $content);
        $this->sitePageService->saveSiteContentByPage($data);
        session()->flash('success', trans('admin.save_site_save_success'));
        return redirect()->back()->with('success', trans('admin.save_site_save_success'));
    }

    public function saveSiteReportPage(Request $request)
    {
        $content = $request->get('report_page');
        $data = array('report_page' => $content);
        $this->sitePageService->saveSiteContentByPage($data);
        session()->flash('success', trans('admin.save_site_save_success'));
        return redirect()->back()->with('success', trans('admin.save_site_save_success'));
    }

    public function saveSiteDisclaimerPage(Request $request)
    {
        $content = $request->get('disclaimer_page');
        $data = array('disclaimer_page' => $content);
        $this->sitePageService->saveSiteContentByPage($data);
        session()->flash('success', trans('admin.save_site_save_success'));
        return redirect()->back()->with('success', trans('admin.save_site_save_success'));
    }
}
