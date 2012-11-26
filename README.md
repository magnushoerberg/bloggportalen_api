
Bloggportalen API php client
===
```
require_once(PATH_TO_TWINGLY_API + '/lib/Twingly.php');

Twingly_Configuration::environment('development'); //production or development
Twingly_Configuration::twinglyId('<YOUR_TWINGLY_ID>');
Twingly_Configuration::twinglyApiKey('<YOUR TWINGLY API_KEY>');

$professional = printResult(Twingly_TopList::getProfessional());
//$private = printResult(Twingly_TopList::getPrivate());

foreach($professional AS $res) {
    echo "blog_url: " . $res -> blog;
    echo "blog_name: " . $res -> blog_name;
    echo "number_of_visists: " . $res -> number_of_visists
}
```
