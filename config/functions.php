<?php

namespace {

    /**
     * @param string      $name
     * @param object|null $target
     * @param array|null  $argv
     *
     * @return \Phpfox\Event\Response
     */
    function _emit($name, $target = null, $argv = [])
    {
        return Phpfox::get('mvc.events')
            ->emit($name, $target, $argv);
    }

    function _pass($action, $roleId = null)
    {
        return \Phpfox::get('authorization')
            ->pass($roleId, $action);
    }

    function _describe_table($table)
    {
        if (substr($table, 0, 1) == ':') {
            $table = PHPFOX_TABLE_PREFIX . substr($table, 1);
        }
        $rows = Phpfox::db()
            ->execute('describe ' . $table)
            ->all();


        $column = [];
        $primary = [];
        $identity = null;
        $queryId = null;

        foreach ($rows as $row) {
            $column[$row['Field']] = 1;

            if (strtolower($row['Key']) == 'pri') {
                $primary[$row['Field']] = 1;
            }

            if (strtolower($row['Extra']) == 'auto_increment') {
                $identity = $row['Field'];
            }
        }

        if ($identity) {
            $queryId = $identity;
        } elseif (count($primary) == 1) {
            $queryId = array_keys($primary)[0];
        }


        return [$identity, $primary, $queryId, $column];
    }

    /**
     * @param array|string $array ['core'=> PHPFOX_DIR
     *                            .'/package/neutron-core/view',...]
     * @param string|null  $config
     *
     * @return array
     */
    function _view_map($config)
    {
        $map = [];
        $extension = '.phtml';
        foreach ($config as $template => $items) {
            foreach ($items as $name => $folder) {
                $directory = realpath(PHPFOX_DIR . $folder);

                if (!$directory || !is_dir($directory)) {
                    return [];
                }

                $startCharacter = strlen($directory);

                $directoryIterator
                    = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory,
                    RecursiveDirectoryIterator::SKIP_DOTS),
                    RecursiveIteratorIterator::SELF_FIRST,
                    RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
                );

                foreach ($directoryIterator as $path => $entry) {
                    if ($entry->isDir()) {
                        continue;
                    }

                    $path = $entry->getPath() . '/' . $entry->getFilename();

                    if (!strpos($path, $extension)) {
                        continue;
                    }

                    $prepare = str_replace($extension, '',
                        substr($path, $startCharacter + 1));

                    $id = $template . '/' . $name . '.' . str_replace([
                            '//',
                            '/',
                            '\\',
                        ],
                            ['.', '.', '.'], _deflect($prepare));

                    $map[$id] = str_replace([PHPFOX_DIR, $extension], ['', ''],
                        $path);
                }
            }
        }


        return $map;
    }

    /**
     * @param array|string $array ['core'=> PHPFOX_DIR
     *                            .'/package/neutron-core/view',...]
     * @param string|null  $dir
     *
     * @return array
     */
    function _get_view_map($array, $dir = null)
    {
        $map = [];
        $extension = '.phtml';
        $packageDir = realpath(PHPFOX_PACKAGE_DIR);

        if (null != $dir) {
            $array = [$array => $dir];
        }

        foreach ($array as $prefix => $directory) {
            $directory = realpath(PHPFOX_PACKAGE_DIR . DS . $directory);
            if (!$directory || !is_dir($directory)) {
                continue;
            }
            $startCharacter = strlen($directory);
            $directoryIterator
                = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory,
                RecursiveDirectoryIterator::SKIP_DOTS),
                RecursiveIteratorIterator::SELF_FIRST,
                RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
            );

            foreach ($directoryIterator as $path => $entry) {
                if ($entry->isDir()) {
                    continue;
                }

                $path = $entry->getPath() . '/' . $entry->getFilename();

                if (!strpos($path, $extension)) {
                    continue;
                }
                $prepare = str_replace($extension, '',
                    substr($path, $startCharacter + 1));

                $key = str_replace(['//', '/', '\\', '@.'],
                    ['.', '.', '.', '@'], _deflect($prefix . DS . $prepare));

                $value = str_replace($extension, '',
                    trim(str_replace($packageDir, '', $path), DS));

                $map[$key] = $value;
            }
        }

        return $map;
    }

    function _file_export($file, $data)
    {
        if (file_exists($file)) {
            @unlink($file);
        }

        if (!is_dir($dir = dirname($file)) && !@mkdir($dir, 0777, true)) {
            exit('Can not open ' . $dir . ' to write export');
        }


        file_put_contents($file,
            '<?php return ' . var_export($data, true) . ';');

        if (file_exists($file)) {
            @chmod($file, 0777);
        }

    }

    /**
     * @param mixed $autoloader
     * @param array $array
     */
    function _autoload_psr4($autoloader, $array)
    {

        foreach ($array as $k => $vs) {
            if (!$k) {
                continue;
            }
            foreach ($vs as $v) {
                $autoloader->addPsr4($k . '\\', PHPFOX_DIR . '/' . $v);
            }
        }
    }

    function _merge_configs($directory, $finder)
    {
        $result = [];

        $directoryIterator
            = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory,
            RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
        );

        foreach ($directoryIterator as $path => $entry) {
            if ($entry->isDir()) {
                continue;
            }

            $path = $entry->getPath() . '/' . $entry->getFilename();

            if (!strpos($path, $finder)) {
                continue;
            }

            $result = array_merge($result, include $path);
        }

        ksort($result);

        return $result;
    }

    function _merge_configs_recursive($directory, $finder)
    {
        $result = [];

        $directoryIterator
            = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory,
            RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST,
            RecursiveIteratorIterator::CATCH_GET_CHILD // Ignore "Permission denied"
        );

        foreach ($directoryIterator as $path => $entry) {
            if ($entry->isDir()) {
                continue;
            }

            $path = $entry->getPath() . '/' . $entry->getFilename();

            if (!strpos($path, $finder)) {
                continue;
            }
            $result = _array_merge_recursive_from_file($result,
                str_replace(PHPFOX_DIR, '', $path));
        }

        ksort($result);

        return $result;
    }

    /**
     * Format a string using $number token
     *
     * <code>
     *  _sprintf('{0} post a {2} on {1}\'s profile', ['Nam', 'Ngon', 'photo']);
     *  // return Nam post a photo on Ngon's profile.</i>
     * </code>
     *
     * @param string $message
     * @param array  $context
     *
     * @return string
     */
    function _sprintf($message, $context)
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        return strtr($message, $replace);
    }

    /**
     * Covert to ascii
     *
     * @param string $string
     *
     * @return string
     */
    function _asciify($string)
    {
        return $string;
    }

    /**
     * Convert string to lower case and split by dasherize
     *
     * @param string $string
     *
     * @return string
     */
    function _dasherize($string)
    {
        return $string;
    }

    /**
     * @param $string
     *
     * @return mixed
     */
    function _inflect($string)
    {
        return str_replace(' ', '',
            ucwords(str_replace(['.', '-'], ' ', $string)));
    }

    /**
     * @param $string
     *
     * @return string
     */
    function _deflect($string)
    {
        return strtolower(trim(preg_replace('/([a-z0-9])([A-Z])/', '\1-\2',
            $string), '-. '));
    }

    function _factory($ref)
    {
        if (is_string($ref)) {
            return new $ref;
        }

        $factory = array_shift($ref);

        if (is_string($factory)) {
            return call_user_func_array([
                new $factory(),
                'factory',
            ], $ref);
        }

        $class = array_shift($ref);

        if (empty($ref)) {
            return new $class();
        }

        return (new \ReflectionClass($class))->newInstanceArgs($ref);
    }

    /**
     * Convert a string to camel and down the first string.
     *
     * @param string $string
     *
     * @return string
     */
    function _camelize($string)
    {
        return $string;
    }

    /**
     * Convert a string to title case.
     *
     * @param string $string
     *
     * @return string
     */
    function _titleize($string)
    {
        return $string;
    }

    /**
     * Convert to path string
     *
     * @param $array
     *
     * @return string
     */
    function _pathize($array)
    {
        return preg_replace('//', PATH_SEPARATOR, implode('/', $array));
    }

    /**
     * @param $data
     *
     * @return string
     */
    function _keyize($data)
    {
        if (is_array($data)) {
            $data = implode('_', $data);
        }
        return preg_replace('/(\W)+/', '_', $data);
    }

    /**
     * @param array $data
     *
     * @return string
     */
    function _attrize($data)
    {
        if (!is_array($data)) {
            return (string)$data;
        }
        $result = [];
        foreach ($data as $name => $value) {
            $result[] = sprintf('%s="%s"', $name, $value);
        }
        return implode(' ', $result);
    }

    /**
     * @param $base
     * @string $file
     *
     * @return mixed
     */
    function _array_merge_recursive_from_file(&$base, $file)
    {
        $array = include PHPFOX_DIR . $file;
        if (is_array($array)) {
            foreach ($array as $k => $v) {
                if (!isset($base[$k])) {
                    $base[$k] = $v;
                } elseif (is_array($v)) {
                    $base[$k] = array_merge($base[$k], $v);
                } else {
                    $base[$k] = $v;
                }
            }
        }
        return $base;
    }

    /**
     * @param array  $base
     * @param string $file
     */
    function _array_merge_from_file(&$base, $file)
    {
        $array = include PHPFOX_DIR . $file;
        if (is_array($array)) {
            $base = array_merge($base, $array);
        }
    }

    /**
     * @param string $key
     * @param array  $context
     * @param null   $query
     *
     * @return string
     */
    function _url($key, $context = [], $query = null)
    {
        return \Phpfox::get('router')->getUrl($key, $context, $query);
    }

    /**
     * @param string $id
     * @param string $domain
     * @param string $locale
     * @param array  $context
     *
     * @return string
     */
    function _text($id, $domain = null, $locale = null, $context = null)
    {
        return \Phpfox::get('translator')
            ->trans($id, $domain, $locale, $context);
    }

    function _yesno($flag)
    {
        return _text($flag ? 'Yes' : 'No');
    }

    /**
     * @param       $message
     * @param array $context
     */
    function _println($message, $context = [])
    {
        echo PHP_EOL, _sprintf($message, $context);
    }
}
