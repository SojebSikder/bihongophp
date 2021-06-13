<?php

namespace System\Libraries;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ZipArchive;

/**
 * Zip Library
 */
class Zip
{
    private $zip;

    public function __construct()
    {
        $this->zip = new ZipArchive;
    }

    /**
     * Zip
     */
    public function zip($url, $rootPath)
    {
        $res = $this->zip->open($url, ZipArchive::CREATE | ZipArchive::OVERWRITE);
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath));

        foreach ($files as $name => $file) {
            if (!$file->isDir()) {
                $filePath = $file; //->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                $this->zip->addFile($filePath, $relativePath);

                return true;
            } else {
                return false;
            }
        }
        $this->zip->close();
    }

    /**
     * Unzip
     */
    public function unzip($url, $distination)
    {
        $res = $this->zip->open($url);
        if ($res === TRUE) {
            $this->zip->extractTo($distination);
            $this->zip->close();

            return true;
        } else {
            return false;
        }
    }
}
