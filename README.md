# Hady Ibrahim's Shopify's Backend Developer Intern - Summer 2022 Submission
## Requirements
* WSL2 (Windows only)
* Docker
* Docker-compose
* MySQL Workbench
## Installation
### Installing Docker
If you are on a windows, you will need [install WSL2](https://docs.microsoft.com/en-us/windows/wsl/install) because Docker must be run on a linux OS

Next download [Docker Desktop](https://docs.docker.com/get-docker/) and get it running so docker works on your linux

### Installing Docker-Compose
The current Docker Desktop install should come with docker-compose. Check this by typing:
```console
docker-compose -v
```
If it isn't installed, follow [Docker Compose Installation](https://docs.docker.com/compose/install/)

### Installing MySQL Workbench
[MySQL Workbench Installation](https://dev.mysql.com/downloads/workbench/)

You could use any database UI if you already have one installed.

## Setup
### Clone the repo
```console
git clone https://github.com/itshady/shopify-back-end.git
```
### Setting up the Database
#### Starting the web app
```console
cd shopify-back-end
docker-compose up -d
```
#### Importing the database
Open MySQL Workbench and add a new connection with the following data:
* Connection Name: _Anything you want to name it_
* Connection Method: Standard (TCP/IP)
* Hostname: 127.0.0.1
* Port: 3306
* Username: root
* Password: password (only if it asks for a password, else store this in vault)
* Default Schema: _Leave this empty_

1. Next, enter the newly made connection and find Server>Data Import.
2. Click "Import from self-contained file" and browse to the shopify.sql file
3. Click Start Import

### Finish
Now that the database is important and the web app is up and running, just navigate to http://localhost:8100/shopify/ and it should be good to go!
