<?php

declare(strict_types=1);

namespace StoneHilt\OpenApi\Tests\Objects;

use StoneHilt\OpenApi\Objects\Contact;
use StoneHilt\OpenApi\Objects\Info;
use StoneHilt\OpenApi\Tests\TestCase;

class ContactTest extends TestCase
{
    /** @test */
    public function create_with_all_parameters_works()
    {
        $contact = Contact::create()
            ->name('GoldSpec Digital')
            ->url('https://goldspecdigital.com')
            ->email('hello@goldspecdigital.com');

        $info = Info::create()
            ->contact($contact);

        $this->assertEquals([
            'contact' => [
                'name' => 'GoldSpec Digital',
                'url' => 'https://goldspecdigital.com',
                'email' => 'hello@goldspecdigital.com',
            ],
        ], $info->toArray());
    }
}
