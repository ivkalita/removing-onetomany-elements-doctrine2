Answer for question http://stackoverflow.com/questions/30562249/removing-onetomany-elements-doctrine2

Installation

```
git clone https://github.com/kaduev13/removing-onetomany-elements-doctrine2.
cd removing-onetomany-elements-doctrine2
php composer.phar install
app/console doctrine:database:create
app/console doctrine:schema:update --force
app/console server:run 127.0.0.1:8002
```

Then go to /gen (it will generate all entities and show you them), and /del (it will delete itineraryVenue from itinerary).
