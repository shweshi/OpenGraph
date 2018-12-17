<?php

namespace shweshi\OpenGraph;

use DOMDocument;

class OpenGraph
{
    public function fetch($url)
    {
        $html = $this->curl_get_contents($url);

        /**
         * parsing starts here:.
         */
        $doc = new DOMDocument();
        @$doc->loadHTML('<?xml encoding="utf-8" ?>' .$html);

        $tags = $doc->getElementsByTagName('meta');
        $metadata = [];

        foreach ($tags as $tag) {
            if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) {
                $key = strtr(substr($tag->getAttribute('property'), 3), '-', '_');
                $value = $tag->getAttribute('content');
            }
            if (!empty($key)) {
                $metadata[$key] = $value;
            }
        }

        return $metadata;
    }

    protected function curl_get_contents($url)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_FAILONERROR, 1);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_ENCODING, 'UTF-8');
        $response = curl_exec($curl);
        curl_close($curl);

        return $response;
    }
}
