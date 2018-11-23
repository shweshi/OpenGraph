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
            'https://www.unsplash.com/'
        );
        $this->assertArrayHasKey('title', $data);
        $this->assertArrayHasKey('description', $data);
        $this->assertArrayHasKey('type', $data);
        $this->assertArrayHasKey('url', $data);
        $this->assertArrayHasKey('image', $data);
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
}
