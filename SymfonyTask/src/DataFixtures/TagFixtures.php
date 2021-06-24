<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for($i = 0;$i<20;$i++){
            $tag = new Tag();
            $tag->setName("tag$i");
            $manager->persist($tag);
            $manager->flush();
        }
    }
}
