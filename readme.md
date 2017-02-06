## Laravel And Vue Js Chat App Using Pusher.com

এই টি লারাভেল ৫.৪ ব্যবহার করা হয়েছে ।

## Documentation


## প্রথমে [Pusher](https://pusher.com/) এ একটি Account খুলুন ।

## তারপর আপনার Project Folder এ নিচের কমান্ড টি Execute করুন ।

```
git clone https://github.com/mehedimi/chat.git
```
## তারপর 
```
cd chat
```
## এবার .env ফাইল টি কপি করার জন্য 
```
cp .env.example .env
```
## এবার Composer Dependency Install করতে 
```
composer install
```
## এবার Database Table Migrate করতে
```
php artisan migrate
```
## এবার Application Key Generate করার পালা
```
php artisan key:generate
```
## এবার আমাদের তৈরি করা Pusher.com এ ডুকে chat নামে একটি App তৈরী করবো । সেখানে APP_ID, KEY, SECRET এই তিন টি HASH Code পাবো । এগুলো আমাদের .env File এ যথাযত স্থানে বসিয়ে Save করবো ।



## এবার আমাদের Application Run করার পালা।
```
php artisan serve
```

Then go to `http://localhost:8000` from your browser and see the app.

হুড়রে এখন নিজে নিজে চ্যাট করি
