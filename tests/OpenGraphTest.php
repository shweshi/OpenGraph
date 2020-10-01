<?php

namespace shweshi\OpenGraph\Test;

use PHPUnit\Framework\TestCase;
use shweshi\OpenGraph\OpenGraph;

class OpenGraphTest extends TestCase
{
    /** @test */
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

    /** @test */
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

    /** @test */
    public function testFetchReturnsEmptyArrayForWebsiteWithNoMetadata()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.example.com/'
        );

        $this->assertEmpty($data);
    }

    /** @test */
    public function testFetchReturnsEmptyArrayForWebsiteWithNoMetadataAndReturnedNotFound()
    {
        $opengraph = new OpenGraph();
        $data = $opengraph->fetch(
            'https://www.example.com/not-found'
        );

        $this->assertEmpty($data);
    }

    /** @test */
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

    /** @test */
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
}
