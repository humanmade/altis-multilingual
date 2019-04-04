# Code Internationalization

When a project is intended to be localized to multiple languages, all the strings in the codebase must also be translated. Any language strings that are "hardcoded" in PHP or JavaScript files must follow the code internationalization practices to ensure they can be translated into any language you want to support.

This is done by passing all strings that your custom code outputs through the translation API functions. This is used to both swap your strings for their translated variant at runtime depending on the language of the site, and also be used as markers to generating translation template files (POT files).

Once you have generated a POT file for you custom code, you can provide your translators with these files. Typically programs such as [poedit](https://poedit.net/) are used to author translations.

## Translation API Functions

Whenever you output a string in code, you must use a translation function. HM Platform uses the [WordPress Translation API](https://codex.wordpress.org/I18n_for_WordPress_Developers) to provide code level internationalization (i18n). Translations in code are tied to a "Text Domain" which is an identifier for which translation file should be used for a given translation. It's recommended you use a single translation domain for all your project's custom code. This will mean you only need to get a single POT file translated.

See [Translatable Strings](https://codex.wordpress.org/I18n_for_WordPress_Developers#Translatable_strings) for details on the functions you should use, depending on context.

## Generating POT files

Once you have ensured all the strings in your custom code are using translation functions, you must generated a POT file from the codebase. This is done use the cli command `wp i18n make-pot`. If you want to generate a POT file for your whole project:

```sh
wp i18n make-pot content --domain=<your-text-domain> <your-text-domain>.pot
```

This will place a new file in at the path `<your-text-doamin>.pot`.

## Installing Translated Files

The POT files you create should be passed to yoru translation team. Their translations should be exported as `.mo` files. Each language will have it's own translated file. Copy the `.mo` files to `content/languages/plugins/<text-domain>-<language-code>-<country-code>.mo`. You must also load the `.mo` file via the `load_plugin_textdomain()` function. This can be done from a custom plugin or within your theme.

```php
load_plugin_textdomain( 'my-text-domain' );
```
