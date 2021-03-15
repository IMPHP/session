# [Auth](auth.md) / [StreamSession](auth-StreamSession.md) :: __construct
 > im\auth\StreamSession
____

## Synopsis
```php
public __construct(null|string $sessid = NULL, im\io\Stream $stream)
```

## Parameters
| Name | Description |
| :--- | :---------- |
| sessid | Restore a session from an existing id.<br />If this is `NULL` a new session is created. |
| stream | Stream to store session data |
