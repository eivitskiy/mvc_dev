<?php

class Image
{
    private $file;
    private $dir;
    private $filename;
    private $ext;
    private $size;
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

        $this->size = getimagesize($this->file);

        if($this->size[0] > $this->max_width || $this->size[1] > $this->max_height) {
            $this->resizing();
        }

        $this->filename = substr(md5(microtime()),0,32);
        $fullname = $this->dir . $this->filename . $this->ext;

        copy($this->file, $fullname);
        unlink($this->file);

        return 'upload/' . $this->filename . $this->ext;
    }

    private function resizing()
    {
        $this->setType()->openImage();

        $coefficient = $this->size[0]/$this->size[1];

        $width = $this->max_width;
        $height = $this->max_height;

        if ($this->max_width/$this->max_height > $coefficient) {
            $width = $this->max_height*$coefficient;
        } else {
            $height = $this->max_width/$coefficient;
        }

        $x = $this->max_width * 100 / $this->size[0];
        $y = $this->max_height * 100 / $this->size[1];

        $coefficient = ($x > $y ? $x : $y);

        $img = imagecreatetruecolor($width,$height);
        imagecopyresampled(
            $img,
            $this->image,
            0,
            0,
            0,
            0,
            $width,
            $height,
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