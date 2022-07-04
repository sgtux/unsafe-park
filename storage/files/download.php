<?php
if (isset($_REQUEST["file"])) {
    
    $file = urldecode($_REQUEST["file"]);

    if (preg_match('/^[^.][-a-z0-9_.]+[a-z]$/i', $file)) {
        $filepath = "images/" . $file;

        if (file_exists($filepath)) {

            $filesize = filesize($filepath);

            $offset = 0;
            $length = $filesize;

            if (isset($_SERVER['HTTP_RANGE'])) {

                $partialContent = true;

                preg_match('/bytes=(\d+)-(\d+)?/', $_SERVER['HTTP_RANGE'], $matches);

                $offset = intval($matches[1]);
                $length = intval($matches[2]) - $offset;
            } else {
                $partialContent = false;
            }

            $file = fopen($filepath, 'r');
            fseek($file, $offset);
            $data = fread($file, $length);
            fclose($file);

            if ($partialContent) {

                header('HTTP/1.1 206 Partial Content');

                header('Content-Range: bytes ' . $offset . '-' . ($offset + $length) . '/' . $filesize);
            }

            header('Content-Type: application/octet-stream');
            header('Content-Length: ' . $length);
            header('Content-Disposition: attachment; filename="' . $filepath . '"');
            header('Accept-Ranges: bytes');

            print($data);
            die();
        } else {
            http_response_code(404);
            die();
        }
    } else {
        http_response_code(400);
        die("Invalid file name!");
    }
}
