# This is makeshift Reddit API

Built with the latest version of Laravel(10.*) 

## Prerequisites 
-  PHP 8.*
-  Composer 2.2.6

- Visit https://laravel.com/docs/10.x for references 

## Installation

Clone the repository locally 

``` git clone git@github.com:ymakanda/Reddit-api.git ```

- cd to your working directory
- Install composer
- copy from .example to new  `.env` file:

AWS url = http://testredit-env.eba-ydmv2gft.us-east-2.elasticbeanstalk.com

To thest the apis you need to append something like 
```bash
     http://testredit-env.eba-ydmv2gft.us-east-2.elasticbeanstalk.com/api/all-post 

     http://localhost:8080/api/search-post-user/{username}
```
## To run it 

```bash
    php artisan  serve
```

## Request a token. Notice that for acquiring a token, requests are made to https://www.reddit.com

Inport this script into your postman or any preferrable way
- Update it your details after copy the token to your env file REDDIT_TOKEN= 

```bash
    curl -X POST -d 'grant_type=password&username=reddit_bot&password=snoo' --user 'p-jcoLKBynTLew:gko_LXELoV07ZBNUXrvWZfzE3aI' https://www.reddit.com/api/v1/access_token
```