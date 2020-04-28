# Nova Markdown

Adds a markdown editor component to Laravel Nova. Based on [easymde](https://easymde.tk). 

![nova markdown screenshot](nova-markdown.png "Nova Markdown in Action")

## Installation instructions

Require `dinandmentink/nova-markdown` using composer:

```bash
composer require dinandmentink/nova-markdown
```

The package will register itself using Laravels package autodiscovery. Now, whenever you want to use a Markdown field use `Markdown::make` like you would expect in the `fields()` method of a Nova resource.

```php
use DinandMentink\Markdown\Markdown;

public function fields(Request $request)
{
    return [
        Markdown::make("Field Name"),
    ];
}
```

It will accept all default Nova options:

```php
use DinandMentink\Markdown\Markdown;

public function fields(Request $request)
{
    return [
        Markdown::make("Content")->rules('required')->hideFromIndex(),
    ];
}
```

## Difference with Nova's own markdown

Nova, ofcourse, offers it's own markdown field. They are similar. Both of them offer inline text highlighting of markdown text. Both of them perform no transformations on the input and simply store it as plain text, usually in a TEXT column. 

This package however will add some more highlighting and toolbar buttons that are not included the default Markdown field:

| Functionality | Default Markdown | Nova Markdown |
| --- | --- | --- |
| Strong  | V | V |
| Italic | V | V |
| External image | V | V |
| Link | V | V |
| Preview | V | V |
| Headings | - | V |
| Blockquotes | - | V |
| Ordered lists | - | V |
| Unordered lists | - | V |
| Side-by-side view | - | V |

## Further development and contributions

At some point I would like to add image handling. Don't hold your breath though, the package currently does what I need it to do. I'm open to pullrequests and aim to ensure this package keeps working as-is with upcoming Nova releases.

Shoutout to [@palauaandsons](https://github.com/palauaandsons/nova-simplemde-field/) for his work that I improved upon and simplified where I needed.

## Todo

- [ ] Write tests
- [ ] Image uploading / handling
