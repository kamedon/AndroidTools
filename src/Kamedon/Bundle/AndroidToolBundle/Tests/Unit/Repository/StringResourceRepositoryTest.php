<?php

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/11/30
 * Time: 15:07
 */
class StringResourceRepositoryTest extends \Symfony\Bundle\FrameworkBundle\Test\WebTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $em;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        static::$kernel = static::createKernel();
        static::$kernel->boot();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @test
     */
    public function stringxmlでDBに登録()
    {
        $date = new \DateTime();
        $zip = __DIR__ . '/../../Data/values.zip';
        $dir = __DIR__ . '/../../Data/temp/' . $date->format('YmdHis');

        $repository = $this->em->getRepository('KamedonAndroidToolBundle:StringResource');
        $repository->register(\Kamedon\Bundle\AndroidToolBundle\Utility\Android\LoadStringXmlResource::loadZip($zip,$dir));
    }

}