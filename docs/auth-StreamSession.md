# [Auth](auth.md) / StreamSession
 > im\auth\StreamSession
____

## Description
An implementation of `im\auth\Session` that stores session data in a Stream.

## Synopsis
```php
class StreamSession extends im\auth\TmpSession implements im\auth\Session {

    // Methods
    public __construct(null|string $sessid = NULL, im\io\Stream $stream)
    public save(): void

    // Inherited Methods
    public get(string $name): mixed
    public set(string $name, mixed $value): void
    public has(string $name): bool
    public remove(string $name): void
    public clear(): void
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__StreamSession&nbsp;::&nbsp;\_\_construct__](auth-StreamSession-__construct.md) |  |
| [__StreamSession&nbsp;::&nbsp;save__](auth-StreamSession-save.md) | Save the current session to storage  A session may load all content to a cache upon creation and work with that cache from that point forward |
| [__StreamSession&nbsp;::&nbsp;get__](auth-StreamSession-get.md) | Get a value from the session |
| [__StreamSession&nbsp;::&nbsp;set__](auth-StreamSession-set.md) | Set/Change a value in the session |
| [__StreamSession&nbsp;::&nbsp;has__](auth-StreamSession-has.md) | Check to see if a value exists |
| [__StreamSession&nbsp;::&nbsp;remove__](auth-StreamSession-remove.md) | Remove a value from the session |
| [__StreamSession&nbsp;::&nbsp;clear__](auth-StreamSession-clear.md) | Clear the entire session |
