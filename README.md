![Example](https://ha.moonling.nl/local/websites/images/supertank-scraper-moonling-nl.png)

## Supertank Scraper Website

"This is a container that has a custom (Python) scraper for https://supertank.nl. The scraper imports the values from the website every 10 minutes into a CSV file. The CSV file is then loaded onto a self-hosted webpage, which is hosted on port 9821 (internal port 80)."

_**Example website: https://supertank-scraper.moonling.nl**_

----------------

## Build it yourself with the provided **Dockerfile**
```
$ cd ~/
$ git clone https://github.com/Tuncay-Ayhan/supertank-scraper-website.git
$ cd supertank-scraper-website
$ docker build -t supertank-scraper-website .
```

### You can then run it with this command:
```
docker run -d -p 9821:80 --name supertank-scraper-website -t supertank-scraper-website
```

----------------

## Use a Docker image from Github
```
docker run -d -p 9821:80 --name supertank-scraper-website -t ghcr.io/tuncay-ayhan/supertank-scraper-website:master

```

----------------

## Use a Docker image from Dockerhub
```
docker run -d -p 9821:80 --name supertank-scraper-website -t tuncaya/supertank-scraper-website:latest
```

----------------

## or use **docker-compose.yml**
**docker-compose.yml** 

```
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
```
