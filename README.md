Bloggportalen API php client
===
Bloggportalen php client to be used with Twinglys bloggportalen api.
Lets start with an example

Example
----
```
require_once(PATH_TO_TWINGLY_API . '/Twingly.php');

//configure the client
Twingly_Configuration::environment('production');
Twingly_Configuration::twinglyId('<YOUR_TWINGLY_ID>');
Twingly_Configuration::twinglyApiKey('<YOUR TWINGLY API_KEY>');

//To create a blog connected to your account do the following:
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

//Get your toplist of professinal bloggers
$professional = Twingly_TopList::getProfessional();
//$private = Twingly_TopList::getPrivate();

foreach($professional AS $res) {
    echo "blog_url: " . $res -> blog;
    echo "blog_name: " . $res -> blog_name;
    echo "number_of_visists: " . $res -> number_of_visists
}
```
In the example we first configure the php client. Then we register the blogger John Smith with his awesome cat blog.
Twingly_Blogg::create makes a post to /blog/new which registers the blogger to your account.
Thus making it appear in your topplists.

Installation
------------
To install just download the .tar file from the download menu and extract it to you preferred location.