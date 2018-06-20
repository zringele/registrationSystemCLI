** HOW TO USE **
Your CLI command have to state the action you want to use like this:
```
php admin_panel.php action=insert
```

Action can be one of the following
*insert
*update
*delete
*import

** insert **
Fields to set:

*firstname - required
*lastname - required
*email - required, unique
*phonenumber1 - required
*phonenumber2 - optional
*comment - optional

*Example*
```
php admin_panel.php action=insert firstname=Zilvinas lastname=Ringele email=zilvinas.ringele@gmail.com phonenumber1=+37069558133 comment=Author
```