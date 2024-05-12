# Heat backend
A backend written in Laravel for web application, that lets user to get database entries as a sorted list and lets admin to change entries.

## Implementation
Main goal was to implement multiple similar controllers, that used different tables with different data layouts. I found a way in inheritance from common abstract controller and injection related models.

In that way, we still have a great flexability (if ever needed, just re-define a required method in a child class controller) AND we don't have to write duplicated code for four times in a row.

Data about table layout (e.g. available coumns, neccesary columns) is accesible from model classes that inherits from `Table` abstract class.

## Another possible approach
This realisation is not the only one that come up in mind – we could just write routes for every action (create, read, update, delete) and pass a {placeholder} into uri, then write four methods, where we could resolve required table. But in that case, if we would need to make even a little change in a logic for one controller, we had to write it all over again.  

## Authentication
I'm using my [implementation of JWT guard driver](https://github.com/oidd/laravel-jwt-auth) for Laravel, but in this project we just need to be sure, that token is valid, without need to check for any rights.

# Deployment
Will write later.
