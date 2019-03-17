## APPLICATION ON [Yii2](https://github.com/yiisoft/yii2)

### INSTALLATION

**Install via Composer**

If you do not have [Composer](http://getcomposer.org/), you may install it by following the
[instructions at getcomposer.org](https://getcomposer.org/doc/00-intro.md).

You can then install the application using the following commands:

```
composer global require "fxp/composer-asset-plugin:~1.0.0"
composer create-project --prefer-dist -s dev "PHPFouda/towers" .
```

### GETTING STARTED

After you install the application, you have to conduct the following steps to initialize the installed application.
You only need to do these once for all.

- Run command `php init --env=Development` to initialize the application with a specific environment.
- Create a new database and adjust the `components['db']` configuration in `common/config/main-local.php` accordingly.
- Download the attached SQL file and import it to the DB. This will create tables needed for the application to work.