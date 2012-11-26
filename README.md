
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
Twingly_Blogg::create(array(                                                                                                                                           
            'blog_url' => "http://blog.example.com",
            'blog_rss' => "http://blog.example.com/feed",
            'blog_name' => "blog name",
            'presentation' => "It's my new super awesome blog, about cats",
            'start_date' => "2012-01-01",
            'professional' => "false",
            'categories' => array('Äventyrsresor och expeditioner'),
            'author' => array(
                'email'=>"john.smith@example.com",
                'username'=>"Johnny Silver",
                'first_name'=>"John",
                'last_name'=>"Smith",
                'presentation'=>"Hello my name is John Smith",
                'birthdate'=>"1707-01-01"
                )
            ));
```
