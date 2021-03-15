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

use Exception;

/**
 * An implementation of `im\auth\Session` that stores session data in a temp property.
 *
 * @note
 *      This session only exists in the duration of a request.
 */
class TmpSession implements Session {

    /** @internal */
    protected string $sessid;

    /** @internal */
    protected array $data = [];

    /**
     * @param $sessid
     *      An id for this session
     */
    public function __construct(string $sessid = null) {
        if (empty($sessid)) {
            $sessid = $this->createSessId();
        }

        $this->sessid = $sessid;
    }

    /**
     * @php
     */
    public function __get(string $name): string {
        if ($name == "id") {
            return $this->sessid;
        }

        throw new Exception("Invalid property name '$name'");
    }

    /**
     * @internal
     */
    protected function createSessId(): string {
        return implode(unpack("H*", random_bytes(8)))."#".substr((string) time(), -5);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function get(string $name): mixed {
        return $this->data[$name] ?? null;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function set(string $name, mixed $value): void {
        $this->data[$name] = $value;
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function has(string $name): bool {
        return array_key_exists($name, $this->data);
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function remove(string $name): void {
        if (array_key_exists($name, $this->data)) {
            unset($this->data[$name]);
        }
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function clear(): void {
        $this->data = [];
    }

    /**
     * @inheritDoc
     */
    #[Override("im\auth\Session")]
    public function save(): void {}

    /**
     * @php
     */
    public function __debugInfo(): array {
        return $this->data;
    }
}
