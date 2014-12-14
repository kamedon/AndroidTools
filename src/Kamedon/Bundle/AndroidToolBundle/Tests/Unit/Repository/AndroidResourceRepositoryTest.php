<?php
namespace Kamedon\Bundle\AndroidToolBundle\Tests\Unit\Repository;

use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsZip;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Created by IntelliJ IDEA.
 * User: kamedon
 * Date: 14/12/14
 * Time: 20:11
 */
class AndroidResourceRepositoryTest extends KernelTestCase
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
        self::bootKernel();
        $this->em = static::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }


    /**
     * @test
     */
    public function StringZipをdbに保存する()
    {
        $date = new \DateTime();
        $zip = __DIR__ . '/../../Data/values.zip';
        $dir = static::$kernel->getContainer()->get('kernel')->getCacheDir() . '/' . time();

        $repository = $this->em->getRepository('KamedonAndroidToolBundle:AndroidString');
        $repository->loadByZip(new StringsZip($zip), $dir);
    }
}