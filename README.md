# Boston Assignment Task

## For running the project properly, make sure you are having Apache & MySQL running, so for this you can install XAMPP & then start Apache % MySQL servers

## Steps to view this assignment:
1) Clone the repository
2) Inside project directory on your local machine, in command line type:
composer install
3) Copy all the contents of .env.example to .env
4) Run the migrations, in command line type:
php artisan migrate
3) Running the project, in command line type:
php artisan serve

Below is the localhost url of your project:
http://127.0.0.1:8000


## Task 1 - Steps:
### Navigate to http://127.0.0.1:8000/hello to see the result

## Task 2 - Steps:
### For adding items, call this http://127.0.0.1:8000/api/addItem url with POST method in Postman
{
    "category": "<category like movie, book>", // required
    "name": "<category name like movie name, book name>", // required
    "description": "<category description like movie description, book description>" // optional
}

Sample Request:
{
    "category": "Movie",
    "name": "Avengers 1",
    "description": "Amazing movie"
}
### For getting items, call this http://127.0.0.1:8000/api/getItems url with GET method in Postman

## Task 3 - Steps:
### Firstly, install FFMpeg tool from this https://www.gyan.dev/ffmpeg/builds/ffmpeg-git-essentials.7z source & extract all the files in C:\ffmpeg\ folder
### Video is processed from Color frame to Grayscale Frame. To process video, call this http://127.0.0.1:8000/api/processVideo url with POST method & the output will be stored in /storage/app/processed folder of your laravel project