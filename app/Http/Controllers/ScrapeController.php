<?php

namespace App\Http\Controllers;

use Goutte\Client;
use App\Scrape;
use Illuminate\Http\Request;

class ScrapeController extends Controller
{

    public function index()
    {
        $scrapes = Scrape::all();
        $url = "";
        return view('result', compact('scrapes','url'));
    }
    public function scrape(Request $req)
    {

        //Validate Input
        $req->validate([
            'url' => 'required|url'
        ]);
        $client = new Client();
        $fertig = array();
        $crawler = $client->request('GET', $req->input('url'));
        /*$link = $crawler->selectLink('Security Advisories')->link();
        $crawler = $client->click($link); */

        $crawler->filter('script')->each(function ($node) {

            print($node->text() . "\n");
        });
        return $fertig;
        //return $fertig;
    }

    public function scrapeTest(Request $req)
    {
        //Validate Input
        $req->validate([
            'url' => 'required|url|unique:scrapes,url'
        ]);
        $url = $req->input('url');
        $client = new Client();
        $crawler = $client->request('GET', $url);

        //Script tags
        $tags_script = $crawler->filter('script')->each(function ($node) {
            return($node->text());
            //return($node);
        });
        $tags_meta_names = $crawler->filter('meta')->extract('name');
        $tags_script_src = $crawler->filter('script')->extract('src');

        //return $tags_script_src;
        foreach($tags_script as $t) {
            print($t."<hr/>");
        }
        return;

        //GTM
        $has_gtm = scrape_website_gtm($tags_script);
        //Google Analytics
        $has_googleanalytics = scrape_website_googleanalytics($tags_script);
        //return $tags
        //AdWords
        $has_googleads = scrape_website_googleads($tags_script);
        //SiteVerification
        $has_siteverification = scrape_website_googlesiteverification($tags_meta_names);

        //CMS
        $cms_result = scrape_cms($url);

        //DB
        $scrape = new Scrape();
        $scrape->url = $url;
        $scrape->gtm = $has_gtm;
        $scrape->ganalytics = $has_googleanalytics;
        $scrape->gads = $has_googleads;
        $scrape->gsite = $has_siteverification;
        if(is_null($cms_result['result']['name'])) {
            $scrape->cms = "Unbekannt";
        }
        else {
            $scrape->cms = $cms_result['result']['name'];
        }
        $scrape->cms_version = $cms_result['result']['version'];
        $scrape->save();

        $scrapes = scrape::all();
        
        //return $cms_result->result->name;
        //$cms_data = json_decode($cms_result); 

        return view('result', compact('url','scrapes'))->with('success','Scrape successful');
    }

    public function update($id) {

        $scrape = Scrape::find($id);
        
        $url = $scrape->url;
        $client = new Client();
        $crawler = $client->request('GET', $url);

        //Script tags
        $tags_script = $crawler->filter('script')->each(function ($node) {
            return($node->text());
        });
        $tags_meta_names = $crawler->filter('meta')->extract('name');

        //GTM
        $has_gtm = scrape_website_gtm($tags_script);
        //Google Analytics
        $has_googleanalytics = scrape_website_googleanalytics($tags_script);
        //AdWords
        $has_googleads = scrape_website_googleads($tags_script);
        //SiteVerification
        $has_siteverification = scrape_website_googlesiteverification($tags_meta_names);

        //CMS
        $cms_result = scrape_cms($url);

        $scrape->url = $url;
        $scrape->gtm = $has_gtm;
        $scrape->ganalytics = $has_googleanalytics;
        $scrape->gads = $has_googleads;
        $scrape->gsite = $has_siteverification;
        if(is_null($cms_result['result']['name'])) {
            $scrape->cms = "Unbekannt";
        }
        else {
            $scrape->cms = $cms_result['result']['name'];
        }
        $scrape->cms_version = $cms_result['result']['version'];
        $scrape->save();

        return redirect()->route('home')->with('success','Scrape Updated');
    } 

    public function delete($id) {
        $scrape = Scrape::find($id);
        $scrape->delete();

        return redirect()->route('home')->with('success','Scrape Deleted');
    }

    
}
