# BaseTerm

A Symfony project created on September 16, 2015, 3:57 pm.

BaseTerm is an open-source and free to use terminology management system built with the primary goal of natively supporting the most popular TBX dialect for exchange, TBX-Basic.  Note that BaseTerm is still under development and bugs are likely to be encountered (Please report them when you do find them! Thanks!).

**BaseTerm relies on an API to handle termbase storage.**

You can choose between two versions of the API:

+ The Python-based CRITI API:  https://github.com/LexTerm/CRITI/tree/master/server
    + This API is more stable and reliable, but may be more difficult to install in a Windows environment.  
    + The CRITI API is no longer being actively developed.

+ A PHP Symfony-based BaseTerm API: https://github.com/byutrg/baseterm-api
    + This API is still being developed and may exhibit unexpected behavior, but it may be easier to install in all OS environments.


## Installation

BaseTerm uses Apache, PHP5, and MySQL (it has been tested using Linux, Windows (Wampserver), and Mac(MAMP)).

### Clone Repository

Clone this git repository to the desired directory on your Apache webserver setup.

```
git clone https://github.com/byutrg/baseterm.git
```

Enter the directory:

```
cd baseterm
```

### Setup MySQL Database and Install Symfony

You will need to create a database for BaseTerm in MySQL along with a user and a password.

Now you must install [Composer](https://getcomposer.org/download/).  You can download it from the website or do the following:

```
curl -sS https://getcomposer.org/installer | php -- --filename=composer
```

Once you have composer in the main directory, you must run it:

```
php composer install
```

You will need to provide the value of `"termbase_api_location"` in parameters.yml.  Default is "localhost:6543", for the CRITI API default deployment configuration.

This should install Symfony and all other requirements for BaseTerm.  You will need to provide information about your MySQL instance.  If you do not know yet, these settings can changed later in the app/config/parameters.yml file.

### Prepare the site

From the main directory run the following:

#### Update the database
```
php app/console doctrine:schema:update --force
```

After initializing the database, you will need to import "languages_regions.sql" located in the "app" directory to have access to Languages and Regions.  In the future this will be changed to happen automatically.

#### Publish

##### Publish to the Development environment
```
php app/console assetic:dump --env=dev
```

##### Publish to the Production environment
```
php app/console assetic:dump --env=prod
```

#### Clear Cache

Note, you may need to fix permissions for the app/cache and app/logs folders after doing this:

```
php app/console cache:clear
```

#### Create First User

You can create the user using the BaseTerm Register page, but you can also do it via terminal command:

```
php app/console fos:user:create
```

#### Promote User

After creating your first user, you will need to promote them to admin.  After this all permissions can be handled internally within BaseTerm.

```
php app\console fos:user:promote [USERNAME] ROLE_ADMIN
```

## Usage

The instructions are included in "Using BaseTerm.docx", which is located in this repository.  

## Credits

Special thanks to the Symfony team and all of the developers who have created libraries for it!

## License

Copyright © (2015-2017) BYU TRG & LTAC Global & CRITI

This software is distributed under the Eclipse Public License.  See the LICENSE file that accompanies this source code for the full license information.