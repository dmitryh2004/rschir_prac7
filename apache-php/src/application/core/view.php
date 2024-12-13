<?php 
class View {
    private $path = null;

    function __construct($path = null) {
        if ($path != null)
            $this->path = $path;
    }

    function generate($content_view = null, $data = null, $message = null) {
        if ($content_view == null) $content_view = $this->path;
        if ($message != null) {
            echo "<p>" . $message . "</p>";
        }
        include "application/views/templates/" . $content_view . ".php";
    }
}
?>