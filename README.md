![Example](https://ha.moonling.nl/local/websites/images/supertank-scraper-moonling-nl.png)

## Supertank Scraper Website

This is a container, that has a custom (python) scraper for https://supertank.nl which also imports the values every 10 minutes into an CSV file. The CSV then get's loaded into a selfhosted webpage, that is being hosted on port 9821 (internal port 80).  

_**Example website: https://supertank-scraper.moonling.nl**_


**docker-compose.yml** 


    version: "3"
    services:
      supertank-scraper-website:
        image: "tuncaya/supertank-scraper-website:latest"
        hostname: supertank-scraper-website
        container_name: supertank-scraper-website
        tty: true
        ports:
          - '9821:80'
        restart: unless-stopped



------

## Build it yourself with the provided **Dockerfile**
```
$ cd ~/
$ git clone git@github.com:Tuncay-Ayhan/supertank-scraper-website.git
$ cd supertank-scraper-website
$ docker build -t supertank-scraper-website .
```

### You can then run it with
```
docker run -d -p 9821:80 --name supertank-scraper-website
```
