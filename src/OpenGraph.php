<?php

namespace shweshi\OpenGraph;

use DOMDocument;
use Illuminate\Support\Facades\Log;
use shweshi\OpenGraph\Exceptions\FetchException;

class OpenGraph
{
    private const string DEFAULT_USER_AGENT = 'Curl';

    private string $userAgent = self::DEFAULT_USER_AGENT;

    /**
     * @throws FetchException
     */
    public function fetch($url, $allMeta = null, $lang = null, $options = LIBXML_NOWARNING | LIBXML_NOERROR): array
    {
        $html = $this->curl_get_contents($url, $lang, $this->userAgent);
        /**
         * parsing starts here:.
         */
        $doc = new DOMDocument();

        $libxml_previous_state = libxml_use_internal_errors(true);
        $doc->loadHTML('<?xml encoding="utf-8" ?>'.$html, $options);
        //catch possible errors due to empty or malformed HTML
        if ($options > 0 && ($options & (LIBXML_NOWARNING | LIBXML_NOERROR)) == 0) {
            Log::warning(libxml_get_errors());
        }
        libxml_clear_errors();
        // restore previous state
        libxml_use_internal_errors($libxml_previous_state);

        $tags = $doc->getElementsByTagName('meta');
        $metadata = [];
        foreach ($tags as $tag) {
            $metaProperty = ($tag->hasAttribute('property')) ? $tag->getAttribute('property') : $tag->getAttribute('name');
            if (!$allMeta && $metaProperty && str_starts_with($tag->getAttribute('property'), 'og:')) {
                $key = strtr(substr($metaProperty, 3), '-', '_');
                $value = $this->get_meta_value($tag);
            }
            if ($allMeta && $metaProperty) {
                $key = (str_starts_with($metaProperty, 'og:')) ? strtr(substr($metaProperty, 3), '-', '_') : $metaProperty;
                $value = $this->get_meta_value($tag);
            }
            if (!empty($key)) {
                $metadata[$key] = $value;
            }
            /*
             * Verify image url
             */
            if (isset($metadata['image'])) {
                $isValidImageUrl = $this->verify_image_url($metadata['image']);
                if (!$isValidImageUrl) {
                    $metadata['image'] = '';
                }
            }
        }

        return $metadata;
    }

    /**
     * @throws FetchException
     */
    protected function curl_get_contents($url, $lang, $userAgent): bool|string
    {
        $headers = [
            'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Cache-Control: no-cache',
            'User-Agent: '.$userAgent,
        ];

        if ($lang) {
            $headers[] = 'Accept-Language: '.$lang;
        }

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_FAILONERROR    => false,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_ENCODING       => 'UTF-8',
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => $headers,
        ]);

        $response = curl_exec($curl);
        if (curl_errno(/** @scrutinizer ignore-type */ $curl) !== 0) {
            throw new FetchException(curl_error(/** @scrutinizer ignore-type */ $curl), curl_errno($curl), null, curl_getinfo(/** @scrutinizer ignore-type */ $curl));
        }

        curl_close(/** @scrutinizer ignore-type */ $curl);

        return $response;
    }

    protected function verify_image_url($url)
    {
        $path = parse_url($url, PHP_URL_PATH);
        $encoded_path = array_map('urlencode', explode('/', $path));
        $url = str_replace($path, implode('/', $encoded_path), $url);
        if (!filter_var($url, FILTER_VALIDATE_URL)) {
            return false;
        }

        try {
            $contextHeaders = ['ssl' => [
                'verify_peer'      => false,
                'verify_peer_name' => false,
            ]];

            if ($this->userAgent !== self::DEFAULT_USER_AGENT) {
                $contextHeaders['http'] = [
                    'user_agent' => $this->userAgent,
                ];
            }

            $streamContext = stream_context_create($contextHeaders);
            $headers = get_headers($url, true, $streamContext);

            return (bool) stripos($headers[0], '200 OK');
        } catch (\Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }

    protected function get_meta_value($tag)
    {
        if (!empty($tag->getAttribute('content'))) {
            $value = $tag->getAttribute('content');
        } elseif (!empty($tag->getAttribute('value'))) {
            $value = $tag->getAttribute('value');
        } else {
            $value = '';
        }

        return $value;
    }

    public function userAgent(string $userAgent): self
    {
        $this->userAgent = $userAgent;

        return $this;
    }
}
