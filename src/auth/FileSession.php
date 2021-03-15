<?php declare(strict_types=1);
/*
 * This file is part of the IMPHP Project: https://github.com/IMPHP
 *
 * Copyright (c) 2017 Daniel Bergløv, License: MIT
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR
 * THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace im\auth;

use Throwable;
use Exception;

/**
 * An implementation of `im\auth\Session` that stores session data in a file.
 */
class FileSession extends TmpSession {

    /** @internal */
    protected string $file;

    /** @internal */
    protected ?string $sig = null;

    /**
     * @param $sessid
     *      Restore a session from an existing id.
     *      If this is `NULL` a new session is created.
     *
     * @param $directory
     *      Directory for the session files.
     *      If this is `NULL` then `session_save_path()` is used.
     *
     * @param $expires
     *      Time in seconds before the session expires.
     */
    public function __construct(string $sessid = null, string $directory = null, int $expires = 86400) {
        parent::__construct($sessid);

        if (empty($directory)) {
            $directory = session_save_path();
        }

        if (!is_dir($directory)
                && !mkdir($directory, 0770)) {

            throw new Exception("Missing session directory '".$directory."'");
        }

        $this->file = sprintf("%s/sess_%s", $directory, $this->id);

        if (is_file($this->file)) {
            $content = file_get_contents($this->file);

            /* Upate timestamp
             */
            touch($this->file);

            if ($content !== false) {
                $this->sig = md5($content);

                try {
                    $content = unserialize($content);

                    if (is_array($content)) {
                        $this->data = $content;
                    }

                } catch (Throwable $e) {}
            }

        } else {
            $this->sig = md5(serialize($this->data));
        }

        if ($expires > 0 && mt_rand(0, 100) == 1 && $handle = opendir($directory)) {
            $time = time();

            while ($file = readdir($handle)) {
                if (substr($file, 0, 5) == "sess_") {
                    $file = sprintf("%s/%s", $directory, (string) $file);

                    if ((filemtime($file) + $expires) < $time
                                && !unlink($file)) {

                        throw new Exception("Failed removing session files during gc");
                    }
                }
            }
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\TmpSession")]
    public function save(): void {
        $data = serialize($this->data);
        $signature = md5($data);

        if (strcmp($signature, $this->sig) != 0) {
            $this->sig = $signature;

            if (!file_put_contents($this->file, $data)) {
                throw new Exception("Failed to write session data to file");
            }
        }
    }
}
