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

/**
 * Defines a session handler.
 *
 * This handler is completly decoupled from PHP's session handler.
 * It does not provide any means of storing the session id, which must be
 * done manually in order to restore a session. This allows you to use the handler
 * for more than just HTTP requests as this handler does not force send cookies to the client.
 *
 * @example
 *
 *      This example uses the HTTP package from IMPHP.
 *
 *      ```php
 *      $request = new ServerRequestBuilder();
 *      $cookie = new CookieHandler();
 *      $cookie->readFromRequest($request);
 *
 *      $sessid = $cookie->get("sessid");
 *      $session = new FileSession($sessid);
 *
 *      if ($session->get("state") == "loggedin") {
 *          // ...
 *      }
 *      ```
 *
 * @var string $id
 *      Read-only property that stores the current session id
 */
interface Session {

    /**
     * Get a value from the session
     *
     * @param $name
     *      Name of the value
     *
     * @return
     *      This will return `NULL` if the name does not exist
     */
    function get(string $name): mixed;

    /**
     * Set/Change a value in the session
     *
     * @param $name
     *      Name of the value
     *
     * @param $value
     *      The value to add
     */
    function set(string $name, mixed $value): void;

    /**
     * Check to see if a value exists
     *
     * @param $name
     *      Name of the value
     *
     * @return
     *      This will return `FALSE` if the value does not exist or `TRUE` if it does.
     */
    function has(string $name): bool;

    /**
     * Remove a value from the session
     *
     * @param $name
     *      Name of the value
     */
    function remove(string $name): void;

    /**
     * Clear the entire session
     */
    function clear(): void;

    /**
     * Save the current session to storage
     *
     * A session may load all content to a cache upon creation
     * and work with that cache from that point forward.
     * This method will instruct the handler to save the current session
     * to storage.
     *
     * @note
     *      Depending on the storage being used, this may have some overheat.
     *      You should call this only ones during destruction of the request.
     */
    function save(): void;

    /**
     * @php
     */
    function __debugInfo(): array;
}
