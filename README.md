useing Laravel 8 version 

clone https://github.com/panchalnital/ipassignment.git

Running Migrations  php artisan migrate

run projects command php artisan serve

route view screen http://127.0.0.1:8000/routerdetails

database file db folder avaible 

blow the list of point 

User should be able to upload above mentioned router details using excel sheet.
- After uploading excel sheet, user should be able to see the uploaded details on page 
- Fields and rows which fails in validation should be highlighted in red color.
     Missing Sapid, Hostname, Loopback and Mac address
     Sapid, Hostname, Loopback and Mac address not as per the format.
- Each row must be editable in UI so that user can change the input and save the specific row
    without page refresh.
- Each row should contain remove button to remove any unwanted entry.
- User should be able to submit this page only if there is not a single gray and red records on the
screen. That means if all records/rows are valid