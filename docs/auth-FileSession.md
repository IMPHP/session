# [Auth](auth.md) / FileSession
 > im\auth\FileSession
____

## Description
An implementation of `im\auth\Session` that stores session data in a file.

## Synopsis
```php
class FileSession extends im\auth\TmpSession implements im\auth\Session {

    // Methods
    public __construct(null|string $sessid = NULL, null|string $directory = NULL, int $expires = 86400)
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
| [__FileSession&nbsp;::&nbsp;\_\_construct__](auth-FileSession-__construct.md) |  |
| [__FileSession&nbsp;::&nbsp;save__](auth-FileSession-save.md) | Save the current session to storage  A session may load all content to a cache upon creation and work with that cache from that point forward |
| [__FileSession&nbsp;::&nbsp;get__](auth-FileSession-get.md) | Get a value from the session |
| [__FileSession&nbsp;::&nbsp;set__](auth-FileSession-set.md) | Set/Change a value in the session |
| [__FileSession&nbsp;::&nbsp;has__](auth-FileSession-has.md) | Check to see if a value exists |
| [__FileSession&nbsp;::&nbsp;remove__](auth-FileSession-remove.md) | Remove a value from the session |
| [__FileSession&nbsp;::&nbsp;clear__](auth-FileSession-clear.md) | Clear the entire session |
