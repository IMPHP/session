# [Auth](auth.md) / TmpSession
 > im\auth\TmpSession
____

## Description
An implementation of `im\auth\Session` that stores session data in a temp property.

 > This session only exists in the duration of a request.  

## Synopsis
```php
class TmpSession implements im\auth\Session {

    // Methods
    public __construct(null|string $sessid = NULL)
    public get(string $name): mixed
    public set(string $name, mixed $value): void
    public has(string $name): bool
    public remove(string $name): void
    public clear(): void
    public save(): void
}
```

## Methods
| Name | Description |
| :--- | :---------- |
| [__TmpSession&nbsp;::&nbsp;\_\_construct__](auth-TmpSession-__construct.md) |  |
| [__TmpSession&nbsp;::&nbsp;get__](auth-TmpSession-get.md) | Get a value from the session |
| [__TmpSession&nbsp;::&nbsp;set__](auth-TmpSession-set.md) | Set/Change a value in the session |
| [__TmpSession&nbsp;::&nbsp;has__](auth-TmpSession-has.md) | Check to see if a value exists |
| [__TmpSession&nbsp;::&nbsp;remove__](auth-TmpSession-remove.md) | Remove a value from the session |
| [__TmpSession&nbsp;::&nbsp;clear__](auth-TmpSession-clear.md) | Clear the entire session |
| [__TmpSession&nbsp;::&nbsp;save__](auth-TmpSession-save.md) | Save the current session to storage  A session may load all content to a cache upon creation and work with that cache from that point forward |
