# Auth

Sandbox playground 1/3: Authorization server

This is a testing environment for trying out new concepts and to play around. However if you were inclined 
to use it for production or to modify it for your own need i would advise refactoring. For the most part i tried to keep to 
all the best practices, but since this is only in the "playing around phase" and i still have no idea of what i am making i do not 
advise using this "as is".


Api uses JWT standards and RS256 encryption to create tokens.

To create SSL private/public key: 
```
$ mkdir config/jwt
$ openssl genrsa -out config/jwt/private.pem -aes256 4096
$ openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
$ openssl rsa -in config/jwt/private.pem -out config/jwt/private2.pem
$ mv config/jwt/private.pem config/jwt/private.pem-back
$ mv config/jwt/private2.pem config/jwt/private.pem
```
Basic usage (Rest client side):

1. Register your self as a user (POST /api/user/register)
2. Register your app as a client (POST /api/client/register -> returns basic token for authentication purposes )
3. Ask for a public key (POST /api/client/key with key received in step 2 as auth header)

(Example: Sandbox playground 2/3: Rest ->  https://github.com/AkronimBlack/Rest)

Basic usage (User client side):

1. Register your self as a user (POST /api/user/register)
2. On login (POST /api/user/token/create -> returns JWT token)
3. Use token as authentication header with every HTTP request

(Example: Sandbox playground 3/3: Front-app ->  https://github.com/AkronimBlack/front-app)




