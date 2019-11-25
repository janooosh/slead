<?php

/**
 * Helper functions: SCRAPERS
 * 
 * This document contains the scraper functions for the different services.
 */

if (!function_exists('scrape_website_gtm')) {
    function scrape_website_gtm($array_to_search)
    {
        //Pattern, REGEX
        //GTM: Must both have a GTM-XXXXXXX and googletagmanager.com within a script tag
        $patterns[] = "/googletagmanager.com/";
        $patterns[] = "/GTM-\b[a-zA-Z0-9]{7}\b/"; //GTM-XXXXXXX <- seven x


        //Match?
        foreach ($array_to_search as $element) {
            //Must match all patterns
            foreach ($patterns as $pattern) {
                $failed = 0;

                if (!preg_match($pattern, $element)) {
                    $failed++;
                }
                if ($failed < 1) {
                    return true;
                }
            }
        }
        return false;
    }
}

if (!function_exists('scrape_website_googleanalytics')) {
    function scrape_website_googleanalytics($array_to_search)
    {
        //Pattern
        //$patterns[] = "/gtag\(\'config\'\,/";
        $patterns[] = "/\'UA-\b[0-9]{6,}/";
        $patterns[] = "/analytics\.js/";
        $patterns[] = "/gtag\.js/";
        $patterns[] = "/ga\.js/";

        //$vergleich[] = "https://www.google-analytics.com/plugins/ua/ec.js";


        //Match? [OR]
        foreach ($array_to_search as $element) {
            //Must match all patterns
            foreach ($patterns as $pattern) {

                if (preg_match($pattern, $element)) {
                    return true;
                }
            }
        }

        return false;
    }
}

if (!function_exists('scrape_website_googleads')) {
    function scrape_website_googleads($array_to_search)
    {
        //Pattern
        $patterns[] = "/gtag\(\'config\'\,/";
        $patterns[] = "/\'AW-\b[0-9]{9,}/";

        //Match?
        foreach ($array_to_search as $element) {
            //Must match all patterns
            foreach ($patterns as $pattern) {
                $failed = 0;

                if (!preg_match($pattern, $element)) {
                    $failed++;
                }
                if ($failed < 1) {
                    return true;
                }
            }
        }
        return false;
    }
}
if (!function_exists('scrape_website_googlesiteverification')) {
    function scrape_website_googlesiteverification($array_to_search)
    {
        //Pattern
        $patterns[] = "google-site-verification";

        //Match?
        //Must match all patterns
        foreach ($patterns as $pattern) {
            $failed = 0;

            if (!in_array($pattern, $array_to_search)) {
                $failed++;
            }
            if ($failed < 1) {
                return true;
            }
        }
        return false;
    }
}

function scrape_cms($url)
{
    $api_key = '3443cdfdfb3e2d8896492292b9e21cec8bedb01c7a1b98ce991f02a793f2c8f2b92546';
    $detector = new \WhatCMS\WhatCMS($api_key);
    $result     = $detector->CheckUrl($url);
    return ($result);
}
