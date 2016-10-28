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
