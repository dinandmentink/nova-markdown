# Nova Markdown

[![Latest Version on Packagist](https://img.shields.io/packagist/v/dinandmentink/nova-markdown.svg?style=flat-square)](https://packagist.org/packages/dinandmentink/nova-markdown)
[![Total Downloads](https://img.shields.io/packagist/dt/dinandmentink/nova-markdown.svg?style=flat-square)](https://packagist.org/packages/dinandmentink/nova-markdown)
![Forks](https://img.shields.io/github/forks/dinandmentink/nova-markdown.svg?style=flat-square)
![Stars](https://img.shields.io/github/stars/dinandmentink/nova-markdown.svg?style=flat-square)
![MIT license](https://img.shields.io/github/license/dinandmentink/nova-markdown.svg?style=flat-square)

Adds a markdown editor component to Laravel Nova. Based on [easymde](https://easymde.tk). 

## Installation instructions

Require `dinandmentink/nova-markdown` using composer:

```bash
composer require dinandmentink/nova-markdown
```

The package will register itself using Laravels' package autodiscovery. Now, whenever you want to use a Markdown field use `Markdown::make` like you would expect in the `fields()` method of a Nova resource.

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

Nova, ofcourse, offers it's own [markdown field](https://nova.laravel.com/docs/1.0/resources/fields.html#markdown-field). Nova's official markdown and this, Nova Markdown, are similar. Both of them offer inline text highlighting of markdown text. Both of them perform no transformations on the input and simply store it as plain text, usually in a TEXT column. 

This package however will add some more highlighting and toolbar buttons that are not included the default Markdown field. But mainly, **Nova Markdown handles image uploads**. 

| Functionality | Default Markdown | Nova Markdown |
| --- | --- | --- |
| Strong | V | V |
| Italic | V | V |
| External image | V | V |
| Link | V | V |
| Preview | V | V |
| Inline image upload | - | V |
| Headings | - | V |
| Blockquotes | - | V |
| Ordered lists | - | V |
| Unordered lists | - | V |
| Side-by-side view | - | V |

## Credits

- Dinand Mentink - dinand@dcreative.nl
- First version based on [@palauaandsons](https://github.com/palauaandsons/nova-simplemde-field/)

## Todo

- [ ] Write tests
