**HOW TO USE**

Your CLI command have to state the action you want to use like this:
```
php admin_panel.php action=insert
```

Action can be one of the following
* insert
* update
* delete
* import

**INSERT**

Fields to set:

* firstname - required
* lastname - required
* email - required, unique
* phonenumber1 - required
* phonenumber2 - optional
* comment - optional

*Example*
```
php admin_panel.php action=insert firstname=Zilvinas lastname=Ringele email=zilvinas.ringele@gmail.com phonenumber1=+37069558133 comment=Author
```

**UPDATE**

You can update any field, or more than one. requires ID

*Example*
```
php admin_panel.php action=update email=zilvinas.ringele@inbox.com id=14
```

**DELETE**

Deletes user by ID

*Example*
```
php admin_panel.php action=delete id=14
```

**IMPORT**

Imports clients from .csv file. File has to be specified with url from script location. 

You can find .csv example as clients.csv

*Example*
```
php admin_panel.php action=import file=clients.csv
```