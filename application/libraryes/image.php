<?php

class Image
{
    private $file;
    private $dir;
    private $filename;
    private $ext;
    private $max_width = 320;
    private $max_height = 240;
    private $allowed_types = [
        'image/png',
        'image/gif',
        'image/jpeg'
    ];
    private $type;
    private $image;

    public function upload($file)
    {
        if(!in_array($file['type'], $this->allowed_types)) {
            return false;
        }

        $this->file = $file['tmp_name'];
        $this->dir = $_SERVER['DOCUMENT_ROOT'] . '/upload/';
        $this->ext = '.' . end(explode(".", $file['name']));

        $size = getimagesize($this->file);

        if($size[0] > $this->max_width || $size[1] > $this->max_height) {
            $this->resizing();
        }

        do {
            $this->filename = substr(md5(microtime()),0,32);
            $fullname = $this->dir . $this->filename . $this->ext;
        } while(!file_exists($fullname));


        copy($this->file, $fullname);
        unlink($this->file);

        return $fullname;
    }

    private function resizing()
    {
        $this->setType()->openImage();

        $img = imagecreatetruecolor($this->max_width,$this->max_height);
        imagecopyresampled(
            $img,
            $this->image,
            0,
            0,
            0,
            0,
            $this->max_width,
            $this->max_height,
            imagesx($this->image),
            imagesy($this->image)
        );

        imagejpeg($img, $this->file);
        imagedestroy($img);

        $this->ext = '.jpg';

        return $this;
    }

    private function setType()
    {
        $mime = mime_content_type($this->file);
        switch($mime) {
            case 'image/jpeg':
                $this->type = "jpg";
                break;
            case 'image/png':
                $this->type = "png";
                break;
            case 'image/gif':
                $this->type = "gif";
                break;
        }
        return $this;
    }

    private function openImage()
    {
        switch($this->type) {
            case 'jpg':
                $this->image = @imagecreatefromjpeg($this->file);
                break;
            case 'png':
                $this->image = @imagecreatefrompng($this->file);
                break;
            case 'gif':
                $this->image = @imagecreatefromgif($this->file);
                break;
        }
        return $this;
    }
}