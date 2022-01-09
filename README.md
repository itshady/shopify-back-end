# Hady Ibrahim's Shopify's Backend Developer Intern - Summer 2022 Submission
## Installing Docker and WSL2
#### If you are on a windows, you will need WSL2 because Docker must be run on a linux OS
[WSL2 Installation](https://docs.microsoft.com/en-us/windows/wsl/install)

#### Next download docker desktop and get it running so docker works on your linux
[Docker Desktop Installation](https://docs.docker.com/get-docker/)

## Installing Docker-Compose
The current Docker Desktop install should come with docker-compose. Check this by typing:
> docker-compose -v

If it isn't installed, follow [Docker Compose Installation](https://docs.docker.com/compose/install/)

## Installing MySQL Workbench
[MySQL Workbench Installation](https://dev.mysql.com/downloads/workbench/)

You could use any database UI if you already have one installed.

## Setting up the Database
#### Starting the web app
cd into the repo folder and run
> docker-compose up -d

#### Importing the database
Open MySQL Workbench and add a new connection with the following data:
* Connection Name: "Anything you want to name it"
* Connection Method: Standard (TCP/IP)
* Hostname: 127.0.0.1
* Port: 3306
* Username: root
* Password: password (only if it asks for a password, else store this in vault)
* Default Schema: shopify

1. Next, enter the newly made connection and find Server>Data Import.
2. Click "Import from self-contained file" and browse to the shopify.sql file
3. Click Start Import

## Finish
Now that the database is important and the web app is up and running, it should be good to go!
