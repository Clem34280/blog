<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class Contact extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $contact = new \App\Entity\Contact();
        $contact->setFirstname('Clément');
        $contact->setName('MURE');
        $contact->setAge(20);
        $contact->setNewsletter(false);

        $manager->persist($contact);

        $manager->flush();
    }
}