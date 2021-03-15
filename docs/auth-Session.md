# [Auth](auth.md) / Session
 > im\auth\Session
____

## Description
Defines a session handler.

This handler is completly decoupled from PHP's session handler.
It does not provide any means of storing the session id, which must be
done manually in order to restore a session. This allows you to use the handler
for more than just HTTP requests as this handler does not force send cookies to the client.

## Synopsis
```php
interface Session {

    // Properties
    string $id

    // Methods
    get(string $name): mixed
    set(string $name, mixed $value): void
    has(string $name): bool
    remove(string $name): void
    clear(): void
    save(): void
}
```

## Properties
| Name | Description |
| :--- | :---------- |
| [__Session&nbsp;::&nbsp;$id__](auth-Session-var_id.md) | Read-only property that stores the current session id |

## Methods
| Name | Description |
| :--- | :---------- |
| [__Session&nbsp;::&nbsp;get__](auth-Session-get.md) | Get a value from the session |
| [__Session&nbsp;::&nbsp;set__](auth-Session-set.md) | Set/Change a value in the session |
| [__Session&nbsp;::&nbsp;has__](auth-Session-has.md) | Check to see if a value exists |
| [__Session&nbsp;::&nbsp;remove__](auth-Session-remove.md) | Remove a value from the session |
| [__Session&nbsp;::&nbsp;clear__](auth-Session-clear.md) | Clear the entire session |
| [__Session&nbsp;::&nbsp;save__](auth-Session-save.md) | Save the current session to storage  A session may load all content to a cache upon creation and work with that cache from that point forward |

## Example 1
This example uses the HTTP package from IMPHP.

```php
$request = new ServerRequestBuilder();
$cookie = new CookieHandler();
$cookie->readFromRequest($request);

$sessid = $cookie->get("sessid");
$session = new FileSession($sessid);

if ($session->get("state") == "loggedin") {
    // ...
}
```
