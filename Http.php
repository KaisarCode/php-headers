<?php
Class Http {
    
    // Allow origin
    static function allowOrigin($origin = '*') {
        @header("Access-Control-Allow-Origin: $origin");
    }
    
    // Set response JSON
    static function setHeaderJson($charset = 'utf-8') {
        @header("Content-Type: application/json; charset=$charset");
    }
    
    // Set response HTML
    static function setHeaderHtml($charset = 'utf-8') {
        @header("Content-Type: text/html; charset=$charset");
    }
    
    // Set response XML
    static function setHeaderXml($charset = 'utf-8') {
        @header("Content-Type: text/xml; charset=$charset");
    }
    
    // Set response Text
    static function setHeaderText($charset = 'utf-8') {
        @header("Content-Type: text/plain; charset=$charset");
    }
    
    // No robots
    static function noRobots() {
        @header('X-Robots-Tag: noindex, nofollow');
    }
    
    // 404 Not found
    static function set404() {
        @header('HTTP/1.1 404 Not Found', true, 404);
    }
    
    // 403 Forbidden
    static function set403() {
        @header('HTTP/1.1 403 Forbidden', true, 403);
    }
    
    // 401 Unauthorized
    static function set401() {
        @header('HTTP/1.1 401 Unauthorized', true, 401);
    }
    
    // 400 Bad Request
    static function set400() {
        @header('HTTP/1.1 400 Bad Request', true, 400);
    }
    
    // 200 OK
    static function set200() {
        @header('HTTP/1.1 200 OK', true, 200);
    }
    
    // Redirect
    static function redirect($url, $is301 = false) {
        if($is301) @header('HTTP/1.1 301 Moved Permanently');
        @header("Location: $url");
    }
    
    // Force HTTPS
    static function forceHttps() {
        if (array_key_exists
        ('HTTPS', $_SERVER) &&
        (empty($_SERVER['HTTPS']) ||
        $_SERVER['HTTPS']==="off")){
            $redir = "https://".
            $_SERVER['HTTP_HOST'].
            $_SERVER['REQUEST_URI'];
            header("Location:$redir");
            exit;
        }
    }
    
    // Download zip
    static function downloadZip($url) {
        $nm = basename($url);
        $fz = filesize($url);
        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=\"$nm\"");
        header("Content-Length: $fz");
        header("Location: $url");
    }
    
    // Clear browser cache
    static function clearBrowserCache() {
        @header('Pragma: no-cache');
        @header('Cache: no-cache');
        @header('Expires: Mon, 01 Jan 1970 00:00:00 GMT');
        @header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
        @header("Cache-Control: post-check=0, pre-check=0", false);
    }
    
    // Get browser lang
    static function getBrowserLang($df = 'en') {
        if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
            $al = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
            return substr($al, 0, 2);
        } else { 
            return substr($df, 0, 2);
        }
    }
    
    // Obtain request body
    static function getHTTPBody() {
        return file_get_contents("php://input");
    }

    // Obtain POST and GET vars
    static function getHTTPVars() {
        $out = array();
        foreach ($_POST as $k => $v) {
            array_push($out, $k);
        }
        foreach ($_GET as $k => $v) {
            array_push($out, $k);
        }
        return $out;
    }
}
