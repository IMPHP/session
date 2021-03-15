# Auth
____

## Description
Seperate Authentication/Authorization package that contains a session library

## Interfaces
| Name | Description |
| :--- | :---------- |
| [Session](auth-Session.md) | Defines a session handler |

## Classes
| Name | Description |
| :--- | :---------- |
| [TmpSession](auth-TmpSession.md) | An implementation of `im\auth\Session` that stores session data in a temp property |
| [FileSession](auth-FileSession.md) | An implementation of `im\auth\Session` that stores session data in a file |
| [StreamSession](auth-StreamSession.md) | An implementation of `im\auth\Session` that stores session data in a Stream |
