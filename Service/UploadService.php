<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 4/10/17
 * Time: 1:31 AM
 */

namespace Xiranst\Bundle\MediaBundle\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadService
{
    private $targetDir;
    private $fileSystem;

    public function __construct($targetDir)
    {
        $this->targetDir = $targetDir;
        $this->fileSystem = new Filesystem();
    }

    public function upload(UploadedFile $file)
    {
        $newName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
        $mimeType = $file->getClientMimeType();
        $originalName = $file->getClientOriginalName();
        $size = $file->getClientSize();
        $file->move($this->targetDir, $newName);
        $result = array(
            'fileName' => $newName,
            'mimeType' => $mimeType,
            'originalName' => $originalName,
            'size' => $size
        );
        return $result;
    }
    // public function test($file)
    // {
    //     dump($file);exit();
    //     return 33;
    // }
    //
    // public function upload(UploadedFile $file, $subDir = null)
    // {
    //     $result = array();
    //     $result['mimeType'] = $file->getClientMimeType();
    //     $result['title'] = $file->getClientOriginalName();
    //     $result['fileSize'] = $file->getClientSize();
    //     $fileName = md5(uniqid()) . '.' . $file->getClientOriginalExtension();
    //     $result['fileName'] =  $fileName;
    //     $targetDir = $this->targetDir;
    //     if($subDir) {
    //         $targetDir .= '/'. $subDir;
    //     }
    //     if(!$this->fileSystem->exists($targetDir)) {
    //         $this->fileSystem->mkdir($targetDir);
    //     }
    //     $file->move($targetDir, $fileName);
    //     return $result;
    // }

    /**
     * scan the target directory and return the file list
     * @param $targetDir
     *
     * @return array|bool
     */
    public function scanDir($targetDir)
    {
        if(!$this->fileSystem->exists($targetDir))
            return false;
        $files = scandir($targetDir);
        $result = array();
        foreach ($files as $file)
        {
            if(substr($file, 0, 1) != '.')
            {
                if($file != 'Thumbs.db')
                {
                    $result[] = $file;
                }
            }
        }
        if(!$result)
            return false;
        return $result;
    }

    public function mkDir($targetDir)
    {
        if(!$this->fileSystem->exists($targetDir)) {
            mkdir($targetDir);
        }
    }

    /**
     * @param $file
     * @param $originalDir
     * @param $targetDir
     *
     * @return array file information
     */
    public function move($file, $originalDir, $targetDir)
    {
        $fileInfo = pathinfo($file);
        $fileSuffix = strtolower($fileInfo['extension']);
        $fileName = md5(uniqid()) . '.' . $fileSuffix;
        $originalFile = $originalDir . $file;
        $targetFile = $targetDir . $fileName;
        if(!$this->fileSystem->exists($targetDir))
        {
            $this->fileSystem->mkdir($targetDir);
        }
        $this->fileSystem->copy($originalFile, $targetFile);
        $result = array(
            'fileName' => $fileName,
            'mimeType' => $fileSuffix
        );
        return $result;
    }

    public function checkDir($dir)
    {
        $result = false;
        if($this->fileSystem->exists($dir))
        {
            $result = true;
        }
        return $result;
    }

    public function copy($originalFile, $targetFile)
    {
        if(!$this->fileSystem->exists($originalFile))
            return false;
        return $this->fileSystem->copy($originalFile, $targetFile);
    }

    public function mirror($originalDir, $targetDir)
    {
        if(!$this->fileSystem->exists($originalDir))
            return false;
        return $this->fileSystem->mirror($originalDir, $targetDir);
    }

    public function rename($originalFile, $targetFile)
    {
        if(!$this->fileSystem->exists($originalFile))
            return false;
        return $this->fileSystem->rename($originalFile, $targetFile);
    }

    public function remove($originalFile)
    {
        if(!$this->fileSystem->exists($originalFile))
            return false;
        return $this->fileSystem->remove($originalFile);
    }

    public function parseCsv($file)
    {
        $file = fopen($file, 'r');
        $data = array();
        while(! feof($file))
        {
            $data[] = fgetcsv($file);
        }
        fclose($file);
        return $data;
    }

    public function unzip($file, $unzipPath)
    {
        if(!$this->fileSystem->exists($unzipPath)) {
            $this->fileSystem->mkdir($unzipPath);
        }
        $zip  = new \ZipArchive();
        $zip->open($file);
        if($zip->open($file) === TRUE)
        {
            $zip->extractTo($unzipPath);
            $zip->close();
        }
    }
}