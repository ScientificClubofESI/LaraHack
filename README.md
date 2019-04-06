# EasyHack

EasyHack is a complete administration systems designed especially for hackathons .
For participants , it's a clean and simple to submit application with or without team and confirm attendance .
For Organizers , it's an easy way to create your hackathon website , view registrations , analyze statistics , Check-In and much more ! 

# Features 

- **WebSite Template** : Easyhack have a website template contain all necessary sections ( About , Challenges , Sponsors .. ) with clean code so you can modify and customize it . 

- **Registration** : With easyhack hackers can register easily with or without team throw a view similar to TypeForm .

- **Statistics** : Admin can view the decision stats and analyze them , registration per day , and much more ! 

- **Dashboard** : Admin can view all application , take a decision and export data to Excel or CSV .

- **Mailing** : Easyhack contain all necessary email view like : 
    - Application recieved : which contain team name and team id .
    - Organizer Decision : Waiting list , Rejected Or Accepted with confirm attendance link .

- **Check-In** : check the participants at the event day . 

- **Settings** : Configure some essential settings ( at the moment it contains only registration mode ) . 

# Screenshots 

![Statistics Page](/Screenshots/Statistics.png)
![Registration Page](/Screenshots/Register.PNG)
![Hackers Table](/Screenshots/Hackers.png)
![Check-In Page](/Screenshots/Checkin.png)

# Setup 

### Quick deploy with Heroku 

### Requirements 
| Requirement                                 | Version |
| ------------------------------------------- | ------- |
| [PHP](https://www.php.net)                | `7.1+`  |
| [Composer](https://getcomposer.org) | `1.8+`  |
| [Laravel](https://laravel.com) | `2.0+`  |
| [MySQL](https://www.mysql.com) | `8.0+`  |

Run the following commands to check the current installed versions:

```bash
laravel --version
php --version
```

For MySQL You can run this command in MySQL Commande Line Client : 
```bash
select version() ;
```

### Deploy locally 

Getting a local instance of EasyHack up and running is very quickly ! Start By Creating A Database on MySQL and go with these steps : 

1 - Clone the repository and cd to the project folder:
```bash
git clone https://github.com/ScientificClubofESI/EasyHack 
cd EasyHack 
```

2 - Install the necessary dependencies:
```bash
composer install  
```

3 - Create your `.env` file from `.env.example` and generate an app key (Don't forget to configure it with the database ) :
```bash
cp .env .env.example
php artisan key:generate  
```

4 - Migrate the database and start listening a queue : 
```bash
php artisan migrate 
php artisan queue:listen database 
```

# Customizing for your event 

### Hackathon name 

Don't forget to put your hackathon name in environment variable `APP_NAME` 

### Hackathon Logo 

Put your hackathon logo in the folder `/public/images` with the name of `LOGO.png`

### Hackathon Landing Page  

You find the hackathon landing page section in the folder `/resources/views/sections` with a clean and simple code 

### Mail Content 

To customize the decision and confirmation emails for your event, edit email templates in 
`/resources/views/emails` 
## Notes : 

- Access to the admin dashboard via the link `/admin` 
- The default mail and password are : `admin@cse.dz` and `cse` you can change them in the migrations folder `database/migrations`

# Contributing 

Do you have a feature request, bug report, or patch? Great! See
[CONTRIBUTING.md][contributing] for information on what you can do about that.
Contributions to EasyHack are welcome and appreciated !

# Feedback / Questions 

If you have any questions about this software, please contact ha_zellat@esi.dz.

# License 

Copyright (c) 2019 Scienitif Club Of ESI (https://github.com/ScientificClubofESI). Released under AGPLv3. See [`LICENSE`][license] for details.


[contribute]: https://github.com/ScientificClubofESI/EasyHack/blob/master/CONTRIBUTING.md
[license]: https://github.com/ScientificClubofESI/EasyHack/blob/master/LICENSE
	
