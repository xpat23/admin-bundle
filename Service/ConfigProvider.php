<?php


namespace Xpat\AdminBundle\Service;


use Symfony\Component\Yaml\Yaml;

class ConfigProvider
{

    private $fileSrc;

    public function __construct($fileSrc)
    {
        $this->fileSrc = $fileSrc;
    }

    public function getConfig() : array
    {
        return Yaml::parse(file_get_contents($this->fileSrc), Yaml::DUMP_OBJECT_AS_MAP);
    }

    public function getConfigSource()
    {
        return $this->fileSrc;
    }

}