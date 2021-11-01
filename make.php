#!/usr/bin/env php
<?php declare(strict_types=1);
/*
 * This file is part of the imphp Project: https://github.com/dk-zero-cool/imphp
 *
 * Copyright (c) 2021 Daniel Bergløv, License: MIT
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

 /* ==========================
  * Configure build
  */
if (!is_dir("src")) {
    echo "Missing source directory 'src/'\n"; exit(1);

} else if (!is_file("stub.php")) {
    echo "Missing default stub 'stub.php'\n"; exit(1);

} else if (is_file("composer.json")) {
    $json = json_decode(
        file_get_contents("composer.json"), true
    );

    if (empty($json["name"])) {
        echo "Missing composer 'name' segment\n"; exit(1);
    }

    $pkgname = str_replace("/", "-", $json["name"]);

} else {
    echo "Missing composer file\n"; exit(1);
}

if (!is_dir("releases")) {
    print "Creating release directory\n";
    if (!mkdir("releases")) {
        echo "Could not create release directory\n"; exit(1);
    }

} else if (is_file("releases/$pkgname.phar")) {
    print "Removing old release\n";
    if (!unlink("releases/$pkgname.phar")) {
        echo "Failed to remove old release build\n";
    }
}

print "Creating phar archive file '$pkgname.phar'\n";
$phar = new Phar("releases/$pkgname.phar", 0, "$pkgname.phar");

/* ==========================
 * Pack all available files
 */
print "Packing files\n";
$path = "src";
$iterator = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($path, FilesystemIterator::FOLLOW_SYMLINKS|FilesystemIterator::SKIP_DOTS|FilesystemIterator::CURRENT_AS_PATHNAME),
                        RecursiveIteratorIterator::SELF_FIRST);

foreach ($iterator as $file) {
    if (is_file($file) && preg_match("/\.php$/", $file)) {
        $local_file = substr($file, strlen($path)+1);

        print " - Adding $local_file\n";
        $phar->addFile($file, $local_file);
    }
}

print " - Adding stub files\n";
if (is_file("static.php")) {
    if (is_file("version")) {
        $phar->addFile("version", "version");
    }

    $phar->addFile("static.php", "static.php");
}
$phar->addFile("stub.php", "stub.php");

/* ==========================
 * Configure default stub
 */
print "Configuring default stub\n";
$phar->startBuffering(); // Allows us to modify the stub content
$phar->setStub(
    $phar->createDefaultStub("stub.php")
);
$phar->stopBuffering();

print "Done!\n";
