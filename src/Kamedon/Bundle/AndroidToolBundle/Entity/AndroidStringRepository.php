<?php

namespace Kamedon\Bundle\AndroidToolBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\AndroidLang;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\ResourceInterface;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsDir;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsXml;
use Kamedon\Bundle\AndroidToolBundle\Utility\Android\Resource\Strings\StringsZip;
use Symfony\Component\Validator\Constraints\Language;

/**
 * AndroidStringRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AndroidStringRepository extends EntityRepository
{
    public function loadByZip(StringsZip $zip,$dir = './')
    {
        $pm = $this->getEntityManager();
        try {
            $pm->beginTransaction();
            /** @var StringsDir $dir */
            foreach ($zip->to($dir)->read() as $dir) {
                $defaultStrings = [];
                /** @var StringsXml $xml */
                foreach ($dir->read() as $xml) {
                    if ($xml->getLang() === AndroidLang::LANG_DEFAULT) {
                        /** @var AndroidString $string */
                        foreach ($xml->read() as $string) {
                            $pm->persist($string);
                            $defaultStrings[$string->getAttr()] = $string;
                        }
                    }
                }

                foreach ($dir->read() as $xml) {
                    if ($xml->getLang() !== AndroidLang::LANG_DEFAULT) {
                        /** @var AndroidString $string */
                        foreach ($xml->read() as $string) {
                            $string->setParent($defaultStrings[$string->getAttr()]);
                            $pm->persist($string);
                        }
                    }
                }
            }
            $pm->flush();
            $pm->getConnection()->commit();
        } catch (\Exception $e) {
            $pm->rollback();
            throw new \RuntimeException();
        }

    }

    public function load(ResourceInterface $resource)
    {
        $pm = $this->getEntityManager();
        try {
            $pm->beginTransaction();
            /** @var AndroidString $string */
            foreach ($resource->load() as $string) {
                $pm->persist($string);
            }
            $pm->flush();
            $pm->getConnection()->commit();
        } catch (\Exception $e) {
            $pm->rollback();
            throw new \RuntimeException();
        }
    }

    public function getParents()
    {
        return $this->findBy(['parent' => null]);
    }

    public function isRegisteredLang(AndroidString $stringResource)
    {
        $res = $this->findOneBy(['value' => $stringResource->getValue(), 'lang' => $stringResource->getLang()]);
        return !is_null($res);
    }

}
