# [Auth](auth.md) / [FileSession](auth-FileSession.md) :: __construct
 > im\auth\FileSession
____

## Synopsis
```php
public __construct(null|string $sessid = NULL, null|string $directory = NULL, int $expires = 86400)
```

## Parameters
| Name | Description |
| :--- | :---------- |
| sessid | Restore a session from an existing id.<br />If this is `NULL` a new session is created. |
| directory | Directory for the session files.<br />If this is `NULL` then `session_save_path()` is used. |
| expires | Time in seconds before the session expires. |
