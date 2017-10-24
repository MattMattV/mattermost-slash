# mattermost-slash

Simple PHP app using Slim to answer to Mattermost slash commands !

## If you want to test it in real condition

- Deploy this mini-app to a provider like Heroku (or your own server)
- Go to https://`your Mattermost server`/`your Mattermost team`/integrations
- Click on "Slash commands"
- Give your command a name
- Give the URL of your server, by default the route is at root of the server
- In request method, choose `POST`
- [OPTIONAL] Provide a display name for the bot answers
- [OPTIONAL] Provide an URL to profile picture of the bot
- Now you can use your command in Mattermost channels !


## BadgeGenerator

Endpoint : `/badgeGenerator`

Method : `POST`

Declare a `BADGE_GENERATOR_TOKEN` environment variable with the token that Mattermost generated for you at the end of the command setup.

That command use https://shields.io/ to provide some custom badge in discussion

Usage : `/<your-trigger> [subject] [status] [color] [style]`

## AH

Endpoint : `/ah`

Method : `POST`

Enjoy Denis Brogniart surprise, when he discover that more men would be able to build a better hut.

Usage : `/ah`

# Clap

Endpoint :clap: `/clap`

Method :clap: POST

Everyone :clap: deserve :clap: recognition

Usage :clap: `/clap`

# Comic

Endpoint : `/comic`

Method : `POST`

Load your favorite comic into your Mattermost.

Usage : `/comic commitstrip|cyanide [fr|en]`

## Details

 - (Commitstrip)[https://www.commitstrip.com] : **commitstrip** : Can be load in fr(ench) or en(glish);
 - (Cyanide and happiness)[http://explosm.net/] : **cyanide** : Only in english.
