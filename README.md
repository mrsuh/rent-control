# Rent Control

![Screen](/screen.png)

## Deploy
```sh
sh bin/deploy.sh
```
## Configuration
config/parameters.yml
```yml
parameters:

    #database default
    database.default.host: 127.0.0.1
    database.default.port: 27017
    database.default.name: rent-collector
    database.default.user: root
    database.default.password: null
    
    #database control
    database.control.host: 127.0.0.1
    database.control.port: 27017
    database.control.name: rent-control
    database.control.user: root
    database.control.password: null
```