# Example Project for My Zoo skill

Install the example project with these lines:

```
git clone https://github.com/travello-gmbh/example-zoo-skill
cd example-zoo-skill
composer install
sudo chmod -R 777 data/cache/
```

Setup a Virtual Host `example-zoo-skill` for the directory `/example-zoo-skill/html/`. 

To check the correct installation of the application, please open the URL http://example-zoo-skill/ in your browser. 
You should get a JSON output with a little welcome message.

If you have Postman up and running, you can import the file `/data/postman/collection.json`. Please check the call
`Zoo LaunchRequest`. If the reponse looks similar to this the installation was successful:

```
    {
        "version": "1.0",
        "sessionAttributes": [],
        "response": {
            "outputSpeech": {
                "type": "SSML",
                "ssml": "<speak>Willkommen in deinem Zoo</speak>"
            },
            "card": {
                "type": "Standard",
                "title": "Willkommen",
                "text": "Willkommen in deinem Zoo",
                "image": {
                    "smallImageUrl": "https://www.travello.audio/cards/zoo-480x480.png",
                    "largeImageUrl": "https://www.travello.audio/cards/zoo-800x800.png"
                }
            },
            "reprompt": {
                "outputSpeech": {
                    "type": "SSML",
                    "ssml": "<speak>Soll ich noch ein Tier nennen oder willst du abbrechen</speak>"
                }
            },
            "shouldEndSession": false
        }
    }
```
