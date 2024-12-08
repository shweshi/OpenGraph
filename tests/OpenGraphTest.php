<?php

namespace shweshi\OpenGraph\Test;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use shweshi\OpenGraph\OpenGraph;

class OpenGraphTest extends TestCase
{
    #[Test]
    public function testFetch()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.ogp.me/'
        );
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('url', $data);
        $this->assertArrayHasKey('image', $data);
    }

    #[Test]
    public function testFetchAllMetadata()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.ogp.me/',
            true
        );
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('url', $data);
        $this->assertArrayHasKey('image', $data);
        $this->assertArrayHasKey('fb:app_id', $data);
    }

    #[Test]
    public function testFetchReturnsEmptyArrayForWebsiteWithNoMetadata()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.example.com/'
        );

        $this->assertEmpty($data);
    }

    #[Test]
    public function testFetchReturnsEmptyArrayForWebsiteWithNoMetadataAndReturnedNotFound()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.example.com/not-found'
        );

        $this->assertEmpty($data);
    }

    #[Test]
    public function testFetchMustacheMetasData()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://raw.githubusercontent.com/jurgenbosch/OpenGraph/master/tests/__mocks__/angular-headers.html',
            true
        );
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('image', $data);
        $this->assertEmpty($data['image']);
    }

    #[Test]
    public function testFetchNonAsciiImageUrlData()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://unitedwithisrael.org/iranians-fall-in-love-with-israel-as-netanyahu-reaches-out-in-persian/',
            true
        );
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('image', $data);
        $this->assertNotEmpty($data['image']);
    }

    #[Test]
    public function testGetHeadersReturns403()
    {
        $urlToFetch = 'https://www.icreatemagazine.nl/nieuws/airtag-hond-of-kat/';
        $graph = new OpenGraph();
        $meta = $graph->fetch($urlToFetch, true);

        self::assertEquals('', $meta['image']);

        $meta = $graph->userAgent('Mozilla/5.0')->fetch($urlToFetch, true);
        self::assertnotEmpty($meta['image']);
    }
}
