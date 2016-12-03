<?php

namespace Phpfox\Storage;


class FileStorageManager implements FileStorageManagerInterface
{
    /**
     * @var FileStorageInterface[]
     */
    protected $vars = [];

    /**
     * @var array
     */
    protected $map = [];

    /**
     * @var string
     */
    protected $default;

    /**
     * @var FileStorageFactoryInterface
     */
    protected $factory;

    /**
     * StorageManager constructor.
     *
     * @param array $configs
     *
     * @throws FileStorageException
     */
    public function __construct($configs)
    {
        $this->map = $configs['map'];
        $this->factory = $configs['factory'];
        $this->default = $configs['default'];
    }

    public function set($id, FileStorageInterface $service)
    {
        $this->vars[$id] = $service;
        return $this;
    }

    public function has($id)
    {
        return isset($this->vars[$id]);
    }

    public function mapUrl($id, $name)
    {
        return $this->get($id)->mapUrl($name);
    }

    public function get($id)
    {
        if (!$id) {
            $id = $this->default;
        }

        return $this->vars[$id] ? $this->vars[$id]
            : $this->vars[$id] = $this->factory->factory($this->map[$id]);
    }

    public function mapCdnUrl($id, $name)
    {
        return $this->get($id)->mapCdnUrl($name);
    }

    public function getUrl($id, $name)
    {
        return $this->get($id)->getUrl($name);
    }

    public function mapPath($id, $name)
    {
        return $this->get($id)->mapPath($name);
    }

    public function putFile($id, $local, $name)
    {
        return $this->get($id)->putFile($local, $name);
    }

    public function getFile($id, $local, $name)
    {
        return $this->get($id)->getFile($local, $name);
    }

    public function deleteFile($id, $name)
    {
        return $this->get($id)->deleteFile($name);
    }


    public function __sleep()
    {
        return ['map', 'default', 'factory'];
    }
}