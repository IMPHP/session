# [Auth](auth.md) / [StreamSession](auth-StreamSession.md) :: save
 > im\auth\StreamSession
____

## Description
Save the current session to storage

A session may load all content to a cache upon creation
and work with that cache from that point forward.
This method will instruct the handler to save the current session
to storage.

 > Depending on the storage being used, this may have some overheat. You should call this only ones during destruction of the request.  

## Synopsis
```php
public save(): void
```
