<?php

class Post
{
    public $id;
    public $title;
    public $content;
    public $alt;
    public $url;
    public $authoredOn;
    public $authoredBy;

    public function __constructor($_id, $_title, $_content, $_alt, $_url, $_authoredOn, $_authoredBy) {
        $this->id = $_id;
        $this->title = $_title;
        $this->content = $_content;
        $this->alt = $_alt;
        $this->url = $_url;
        $this->authoredOn = $_authoredOn;
        $this->authoredBy = $_authoredBy;
    }

    public function izpisiCeloto() {
        return $this->content;
    }

    public function izpisiOsnutek() {
        $teaser = substr($this->content, 0, 150);
        $teaser = strrev($teaser);
        $teaser = substr($content, strpos($teaser, " "));
        $teaser = strrev($teaser);

        return $teaser;
    }

    public function izpisiNaslov() {
        return $this->title;
    }
}